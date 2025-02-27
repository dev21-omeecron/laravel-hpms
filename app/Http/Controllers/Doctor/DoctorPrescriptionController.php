<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrescriptionRequest;
use Illuminate\Support\Facades\{DB, Auth, Log};

class DoctorPrescriptionController extends Controller
{
  public function create($aptid)
  {
    $appointment = DB::table('appointments')
      ->where('aptid', $aptid)
      ->first();

    return view('content.doctor.prescription', compact('appointment'));
  }

  public function store(PrescriptionRequest $request)
  {
    try {
      DB::beginTransaction();

      $doctor = Auth::guard('doctor')->user();
      if (!$doctor) {
        return response()->json([
          'success' => false,
          'message' => 'Doctor authentication failed.'
        ], 401);
      }

      // Use validated data from the request
      $validatedData = $request->validated();

      DB::table('prestb')->insert([
        'aptid' => $validatedData['aptid'],
        'docname' => $doctor->docname,
        'did' => $doctor->did,
        'pid' => $validatedData['pid'],
        'patname' => $validatedData['patname'],
        'appdate' => $validatedData['appdate'],
        'apptime' => $validatedData['apptime'],
        'disease' => $validatedData['disease'],
        'allergies' => $validatedData['allergies'],
        'prescription' => $validatedData['prescription'],
        'is_paid' => 0,
        'payment_method' => $validatedData['payment_method'] ?? null,
        'payment_details' => $validatedData['payment_details'] ?? null,
        'created_at' => now(),
        'updated_at' => now()
      ]);

      DB::commit();

      return response()->json([
        'success' => true,
        'message' => 'Prescription saved successfully!'
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Prescription Error: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());

      return response()->json([
        'success' => false,
        'message' => 'Failed to save prescription. Error: ' . $e->getMessage()
      ], 500);
    }
  }

  public function getPrescriptionList()
  {
    $doctor = Auth::guard('doctor')->user();
    if (!$doctor) {
      return redirect()->route('login');
    }

    // Fetch Prescription details from logged-in doctor
    $prescriptions = DB::table('prestb as p')
      ->join(
        DB::raw("(SELECT aptid, MAX(updated_at) as max_updated_at FROM prestb GROUP BY aptid) as latest"),
        function ($join) {
          $join->on('p.aptid', '=', 'latest.aptid')
            ->on('p.updated_at', '=', 'latest.max_updated_at');
        }
      )
      ->where('did', $doctor->did)
      ->orderBy('p.created_at', 'desc')
      ->get();

    return view('content.doctor.prescription-list', compact('prescriptions'));
  }
}
