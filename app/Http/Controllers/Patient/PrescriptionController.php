<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Prescription;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;


class PrescriptionController extends Controller
{
  public function index()
  {
    if (!Auth::guard('patient')->check()) {
      return redirect()->route('login');
    }
    return view('content.patient.prescription-history');
  }

  public function getPrescriptionHistory()
  {
    $patient = Auth::guard('patient')->user();
    if (!$patient) {
      return redirect()->route('login');
    }

    $prescriptions = DB::table('prestb as p')
      ->join(DB::raw("(SELECT aptid, MAX(updated_at) as max_updated_at FROM prestb GROUP BY aptid) as latest"), function ($join) {
        $join->on('p.aptid', '=', 'latest.aptid')
          ->on('p.updated_at', '=', 'latest.max_updated_at');
      })
      ->where('p.pid', $patient->pid)
      ->orderBy('p.created_at', 'desc')
      ->get();

    return view('content.patient.prescription-history', compact('prescriptions'));
  }

  public function processBillPayment(Request $request, $aptid)
  {
    $request->validate([
      'payment_method' => 'required|string|in:Cash,Credit Card,Debit Card,UPI,Net Banking',
      'payment_details' => 'required|string|max:255',
      'billing_notes' => 'nullable|string|max:255'
    ]);

    try {
      DB::table('prestb')
        ->where('aptid', $aptid)
        ->update([
          'is_paid' => 1,
          'payment_method' => $request->payment_method,
          'payment_details' => $request->payment_details,
          'updated_at' => now()
        ]);

      return redirect()
        ->back()
        ->with('success', 'Payment processed successfully!');
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', 'Failed to process payment. Please try again.');
    }
  }

  public function generateInvoice($aptid)
  {
    $prescription = Prescription::with('appointment')
      ->where('aptid', $aptid)
      ->latest('updated_at')
      ->firstOrFail();

    $patient = Auth::guard('patient')->user();

    $data = [
      'prescription' => $prescription,
      'patient' => $patient,
      'appointment' => $prescription->appointment,
      'date' => now()->format('Y-m-d'),
    ];

    $pdf = Pdf::loadView('content.patient.invoice', $data);
    return $pdf->stream('invoice_appointment_' . $prescription->aptid . '.pdf');
  }
}
