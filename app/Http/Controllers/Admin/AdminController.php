<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Export;

class AdminController extends Controller
{
  public function getDoctorList()
  {
    if (!Auth::guard('admin')->check()) {
      return redirect()->route('login');
    }
    return view('content.admin.doctor-list');
  }

  public function deleteDoctor($did)
  {
    try {
      $deleted = DB::table('doctreg')->where('did', $did)->delete();
      if ($deleted) {
        return redirect()->back()->with('success', 'Doctor deleted successfully.');
      } else {
        return redirect()->back()->with('error', 'Doctor not found or already deleted.');
      }
    } catch (\Exception $e) {
      Log::error("Error deleting doctor: " . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting doctor. Please try again.');
    }
  }

  public function getPatientList()
  {
    if (!Auth::guard('admin')->check()) {
      return redirect()->route('login');
    }

    $patients = DB::table('patreg')
      ->select('pid', 'username', 'email', 'contact')
      ->get();

    return view('content.admin.patient-list', compact('patients'));
  }

  public function deletePatient($pid)
  {
    try {
      $deleted = DB::table('patreg')->where('pid', $pid)->delete();
      if ($deleted) {
        return redirect()->back()->with('success', 'Patient deleted successfully.');
      } else {
        return redirect()->back()->with('error', 'Patient not found or already deleted.');
      }
    } catch (\Exception $e) {
      Log::error("Error deleting patient: " . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting patient. Please try again.');
    }
  }

  public function getAppointmentDetails()
  {
    if (!Auth::guard('admin')->check()) {
      return redirect()->route('login');
    }

    $appointments = DB::table('appointments')
      ->select('aptid', 'patname', 'email', 'contact', 'docname', 'docFees', 'spec', 'appdate', 'apptime')
      ->get();

    return view('content.admin.appointment-details', compact('appointments'));
  }

  public function deleteAppointment($aptid)
  {
    try {
      $deleted = DB::table('appointments')->where('aptid', $aptid)->delete();
      if ($deleted) {
        return redirect()->back()->with('success', 'Appointment deleted successfully.');
      } else {
        return redirect()->back()->with('error', 'Appointment not found or already deleted.');
      }
    } catch (\Exception $e) {
      Log::error("Error deleting appointment: " . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting appointment. Please try again.');
    }
  }

  // Datatable for doctor list
  public function getDoctorListData(Request $request)
  {
    if (!Auth::guard('admin')->check()) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    $doctors = DB::table('doctreg')
      ->select('did', 'docname', 'email', 'contact', 'spec', 'docFees');

    // Apply search
    if ($request->has('search') && !empty($request->input('search.value'))) {
      $search = $request->input('search.value');
      $doctors->where(function ($query) use ($search) {
        $query->where('did', 'like', "%{$search}%")
          ->orWhere('docname', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%")
          ->orWhere('contact', 'like', "%{$search}%")
          ->orWhere('spec', 'like', "%{$search}%")
          ->orWhere('docFees', 'like', "%{$search}%");
      });
    }

    // Apply ordering
    if ($request->has('order') && count($request->input('order'))) {
      $orderColumn = $request->input('order')[0]['column'];
      $orderDirection = $request->input('order')[0]['dir'];

      $columns = ['did', 'docname', 'email', 'contact', 'spec', 'docFees'];
      if (isset($columns[$orderColumn])) {
        $doctors->orderBy($columns[$orderColumn], $orderDirection);
      }
    } else {
      $doctors->orderBy('did', 'asc'); // Default sorting
    }

    // Apply pagination
    $totalRecords = DB::table('doctreg')->count();
    $filteredRecords = $doctors->count();
    $doctors = $doctors->skip($request->input('start', 0))
      ->take($request->input('length', 10))
      ->get();

    Log::info('Doctor list data response:', [
      'draw' => $request->input('draw', 1),
      'totalRecords' => $totalRecords,
      'filteredRecords' => $filteredRecords,
      'data' => $doctors->toArray()
    ]);

    return DataTables::of($doctors)
      ->addColumn('action', function ($doctor) {
        return '<form action="' . route('admin.doctor-list.delete', $doctor->did) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this doctor?\');">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>';
      })
      ->setTotalRecords($totalRecords)
      ->setFilteredRecords($filteredRecords)
      ->skipPaging()
      ->make(true); // return JSON DataTables::of($doctors)
  }

  public function exportDoctorsCSV()
  {
    $doctors = DB::table('doctreg')->get();
    $headers = [
      'Doctor ID',
      'Doctor Name',
      'Doctor Email',
      'Contact',
      'Specialization',
      'Consultancy Fees'
    ];

    $callback = function () use ($doctors, $headers) {
      $file = fopen('php://output', 'w');
      fputcsv($file, $headers);

      foreach ($doctors as $doctor) {
        fputcsv($file, [
          $doctor->did,
          $doctor->docname,
          $doctor->email,
          $doctor->contact,
          $doctor->spec,
          $doctor->docFees
        ]);
      }

      fclose($file);
    };

    return response()->stream($callback, 200, [
      'Content-Type' => 'text/csv',
      'Content-Disposition' => 'attachment; filename="doctors_' . now()->format('Ymd_His') . '.csv"'
    ]);
  }

  public function exportDoctorsPDF()
  {
    $doctors = DB::table('doctreg')->get();
    $pdf = Pdf::loadView('pdf.doctor-list', compact('doctors'));
    return $pdf->stream('doctors_' . now()->format('Ymd_His') . '.pdf');
  }

  public function exportDoctorsExcel()
  {
    $doctors = DB::table('doctreg')->get();
    $headers = [
      'Doctor ID',
      'Doctor Name',
      'Doctor Email',
      'Contact',
      'Specialization',
      'Consultancy Fees'
    ];

    $data = $doctors->map(function ($doctor) {
      return [
        $doctor->did,
        $doctor->docname,
        $doctor->email,
        $doctor->contact,
        $doctor->spec,
        $doctor->docFees
      ];
    })->toArray();

    return Excel::download(
      new \Maatwebsite\Excel\Concerns\Export(function ($writer) use ($headers, $data) {
        $writer->getSheetByIndex(0)->setTitle('Doctors');
        $writer->getSheetByIndex(0)->fromArray(array_merge([$headers], $data));
      }),
      'doctors_' . now()->format('Ymd_His') . '.xlsx'
    );
  }

  // Datatable for patient list
  public function getPatientListData(Request $request)
  {
    if (!Auth::guard('admin')->check()) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    $patients = DB::table('patreg')
      ->select('pid', 'username', 'email', 'contact');

    // Apply search
    if ($request->has('search') && !empty($request->input('search.value'))) {
      $search = $request->input('search.value');
      $patients->where(function ($query) use ($search) {
        $query->where('pid', 'like', "%{$search}%")
          ->orWhere('username', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%")
          ->orWhere('contact', 'like', "%{$search}%");
      });
    }

    // Apply ordering
    if ($request->has('order') && count($request->input('order'))) {
      $orderColumn = $request->input('order')[0]['column'];
      $orderDirection = $request->input('order')[0]['dir'];

      $columns = ['pid', 'username', 'email', 'contact'];
      if (isset($columns[$orderColumn])) {
        $patients->orderBy($columns[$orderColumn], $orderDirection);
      }
    } else {
      $patients->orderBy('pid', 'desc'); // Default sorting
    }

    // Apply pagination
    $totalRecords = DB::table('patreg')->count();
    $filteredRecords = $patients->count();
    $patients = $patients->skip($request->input('start', 0))
      ->take($request->input('length', 10))
      ->get();

    Log::info('Patient list data response:', [
      'draw' => $request->input('draw', 1),
      'totalRecords' => $totalRecords,
      'filteredRecords' => $filteredRecords,
      'data' => $patients->toArray()
    ]);

    return DataTables::of($patients)
      ->addColumn('action', function ($patient) {
        return '<form action="' . route('admin.patient-list.delete', $patient->pid) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this patient?\');">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="' . csrf_token() . '">
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>';
      })
      ->setTotalRecords($totalRecords)
      ->setFilteredRecords($filteredRecords)
      ->skipPaging()
      ->make(true);
  }

  public function exportPatientsCSV()
  {
    $patients = DB::table('patreg')->get();
    $headers = [
      'Patient ID',
      'Patient Name',
      'Patient Email',
      'Patient Contact'
    ];

    $callback = function () use ($patients, $headers) {
      $file = fopen('php://output', 'w');
      fputcsv($file, $headers);

      foreach ($patients as $patient) {
        fputcsv($file, [
          $patient->pid,
          $patient->username,
          $patient->email,
          $patient->contact
        ]);
      }

      fclose($file);
    };

    return response()->stream($callback, 200, [
      'Content-Type' => 'text/csv',
      'Content-Disposition' => 'attachment; filename="patients_' . now()->format('Ymd_His') . '.csv"'
    ]);
  }

  public function exportPatientsPDF()
  {
    $patients = DB::table('patreg')->get();
    $pdf = Pdf::loadView('pdf.patient-list', compact('patients'));
    return $pdf->stream('patients_' . now()->format('Ymd_His') . '.pdf');
  }

  public function exportPatientsExcel()
  {
    $patients = DB::table('patreg')->get();
    $headers = [
      'Patient ID',
      'Patient Name',
      'Patient Email',
      'Patient Contact'
    ];

    $data = $patients->map(function ($patient) {
      return [
        $patient->pid,
        $patient->username,
        $patient->email,
        $patient->contact
      ];
    })->toArray();

    return Excel::download(
      new \Maatwebsite\Excel\Concerns\Export(function ($writer) use ($headers, $data) {
        $writer->getSheetByIndex(0)->setTitle('Patients');
        $writer->getSheetByIndex(0)->fromArray(array_merge([$headers], $data));
      }),
      'patients_' . now()->format('Ymd_His') . '.xlsx'
    );
  }
}
