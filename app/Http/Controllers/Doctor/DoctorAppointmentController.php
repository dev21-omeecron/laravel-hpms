<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorAppointmentController extends Controller
{
  public function getPatientAppointments()
  {
    $doctor = Auth::guard('doctor')->user();
    if (!$doctor) {
      return redirect()->route('login');
    }
    // Fetch patient appointments for the logged-in doctor
    $appointments = DB::table('appointments')
      ->where('did', $doctor->did)
      ->orderBy('created_at', 'desc')
      ->get();
    return view('content.doctor.appointments', compact('doctor', 'appointments'));
  }

  public function cancelAppointment($aptid)
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
