<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AppointmentController extends Controller
{
  public function index()
  {
    if (!Auth::guard('patient')->check()) {
      return redirect()->route('login');
    }
    return view('content.patient.book-appointment');
  }

  public function getAppointmentData(Request $request)
  {
    $request->validate([
      'type' => 'required|in:specializations,doctors,fees'
    ]);

    try {
      switch ($request->type) {
        case 'specializations':
          $data = DB::table('doctreg')
            ->distinct()
            ->pluck('spec');
          break;

        case 'doctors':
          $request->validate(['spec' => 'required']);
          $data = DB::table('doctreg')
            ->where('spec', $request->spec)
            ->select('did', 'docname')
            ->get();
          break;

        case 'fees':
          $request->validate(['did' => 'required']);
          $data = DB::table('doctreg')
            ->where('did', $request->did)
            ->select('docFees')
            ->first();
          break;

        default:
          $data = null;
          break;
      }

      return response()->json($data);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Error fetching data'], 500);
    }
  }

  // Store a new appointment using AppointmentRequest validation
  public function store(AppointmentRequest $request)
  {
    try {
      DB::beginTransaction();

      // Fetch Doctor details
      $doctor = DB::table('doctreg')
        ->where('did', $request->did)
        ->first();

      if (!$doctor) {
        return response()->json([
          'success' => false,
          'message' => 'Selected doctor not found.'
        ], 404);
      }

      // Authenticated patient details
      $patient = Auth::guard('patient')->user();
      if (!$patient) {
        return response()->json([
          'success' => false,
          'message' => 'Patient not authenticated.'
        ], 401);
      }

      // Insert appointment into the database
      DB::table('appointments')->insert([
        'aptid'         => rand(1000000000, 9999999999),
        'pid'           => $patient->pid,
        'did'           => $request->did,
        'patname'       => $patient->username,
        'email'         => $patient->email,
        'contact'       => $patient->contact,
        'docname'       => $doctor->docname,
        'docFees'       => $doctor->docFees,
        'spec'          => $request->spec,
        'apptime'       => $request->apptime,
        'appdate'       => $request->appdate,
        'userStatus'    => 1,
        'doctorStatus'  => 0,
        'created_at'    => now(),
        'updated_at'    => now()
      ]);

      DB::commit();

      return response()->json([
        'success' => true,
        'message' => 'Appointment booked successfully!'
      ]);
    } catch (\Exception $e) {
      DB::rollBack();

      // \Log::error("Appointment Booking Error: " . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Error booking appointment. Please try again. ' . $e->getMessage()
      ], 500);
    }
  }

  public function getAppointmentHistory()
  {
    $patient = Auth::guard('patient')->user();
    if (!$patient) {
      return redirect()->route('login');
    }
    // Fetch appointments for the logged-in patient
    $appointments = DB::table('appointments')
      ->where('pid', $patient->pid)
      ->orderBy('created_at', 'desc')
      ->get();
    return view('content.patient.appointment-history', compact('appointments'));
  }

  public function cancelAppointmentbyPatient($aptid)
  {
    try {
      $deleted = DB::table('appointments')
        ->where('aptid', $aptid)
        ->delete();

      if ($deleted) {
        return redirect()->back()->with('success', 'Appointment cancelled successfully.');
      } else {
        return redirect()->back()->with('error', 'Appointment not found or already cancelled.');
      }
    } catch (\Exception $e) {
      Log::error("Error cancelling appointment: " . $e->getMessage());
      return redirect()->back()->with('error', 'Error cancelling appointment. Please try again.');
    }
  }
}
