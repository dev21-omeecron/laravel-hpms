<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Patient\AppointmentController;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\DoctorRegistrationController;
use App\Http\Controllers\Doctor\DoctorAppointmentController;
use App\Http\Controllers\Doctor\DoctorPrescriptionController;
use App\Http\Controllers\Patient\PrescriptionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ChangePasswordController;

// Authentication Routes
Route::get('/register', function () {
  return view('content.auth.register');
})->name('register');
Route::post('/register', [RegistrationController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])
  ->name('login')
  ->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])
  ->name('change-password.form');
Route::post('/change-password', [ChangePasswordController::class, 'updatePassword'])
  ->name('change-password.update');


// Doctor Registration Routes
Route::get('/auth/add-doctor', function () {
  return view('content.auth.add-doctor');
})->name('add-doctor.page');
Route::post('/auth/add-doctor', [DoctorRegistrationController::class, 'register'])->name('add-doctor');


// Home route with role-based access
Route::get('/home', function () {
  if (Auth::guard('patient')->check()) {
    return view('content.home', ['role' => 'patient']);
  } elseif (Auth::guard('doctor')->check()) {
    return view('content.home', ['role' => 'doctor']);
  } elseif (Auth::guard('admin')->check()) {
    return view('content.home', ['role' => 'admin']);
  }
  return redirect()->route('login');
})->name('home');

// Patient Role Routes
Route::group([
  'middleware' => ['auth:patient', 'role:patient'],
  'prefix' => 'patient',
  'as' => 'patient.'
], function () {
  Route::get('/book-appointment', [AppointmentController::class, 'index'])
    ->name('book-appointment');
  Route::post('/get-appointment-data', [AppointmentController::class, 'getAppointmentData'])
    ->name('get-appointment-data');
  Route::post('/appointments', [AppointmentController::class, 'store'])
    ->name('appointments.store');
  Route::get('/appointment-history', [AppointmentController::class, 'getAppointmentHistory'])
    ->name('appointment-history');
  Route::post('/appointments/{aptid}/cancel', [AppointmentController::class, 'cancelAppointmentbyPatient'])
    ->name('appointments.cancel');
  Route::get('/prescription-history', [PrescriptionController::class, 'getPrescriptionHistory'])
    ->name('prescription-history');
  Route::post('/prescription/{id}/pay', [PrescriptionController::class, 'processBillPayment'])->name('prescription.pay');
  Route::get('/prescription/{aptid}/invoice', [PrescriptionController::class, 'generateInvoice'])->name('prescription.invoice');
});

// Doctor Role Routes
Route::group([
  'middleware' => ['auth:doctor', 'role:doctor'],
  'prefix' => 'doctor',
  'as' => 'doctor.'
], function () {
  Route::get('/appointments', [DoctorAppointmentController::class, 'getPatientAppointments'])
    ->name('appointments');
  Route::post('/appointments/{aptid}/cancel', [DoctorAppointmentController::class, 'cancelAppointment'])
    ->name('appointments.cancel');
  Route::get('/appointments/{aptid}/prescribe', [DoctorPrescriptionController::class, 'create'])
    ->name('prescription.create');
  Route::get('/prescription',  function () {
    return view('content.doctor.prescription');
  })->name('prescription.page');
  Route::post('/prescription', [DoctorPrescriptionController::class, 'store'])
    ->name('prescription.store');

  Route::get('/prescription-list', function () {
    return view('content.doctor.prescription-list');
  })->name('prescription-list.page');
  Route::get('/prescription-list', [DoctorPrescriptionController::class, 'getPrescriptionList'])
    ->name('prescription-list');
  Route::post('/patient/prescription/{aptid}/pay', [PrescriptionController::class, 'processBillPayment'])
    ->name('patient.prescription.pay');
});


// Admin Role Routes 
Route::group([
  'middleware' => ['auth:admin', 'role:admin'],
  'prefix' => 'admin',
  'as' => 'admin.'
], function () {
  Route::get('/doctor-list', [AdminController::class, 'getDoctorList'])
    ->name('doctor-list');
  Route::post('/doctor-list/{did}/delete', [AdminController::class, 'deleteDoctor'])
    ->name('doctor-list.delete');
  Route::get('/patient-list', [AdminController::class, 'getPatientList'])->name('patient-list');
  Route::post('/patient-list/{pid}/delete', [AdminController::class, 'deletePatient'])
    ->name('patient-list.delete');
  Route::get('/appointment-details', [AdminController::class, 'getAppointmentDetails'])
    ->name('appointment-details');
  Route::post('/appointment-details/{aptid}/delete', [AdminController::class, 'deleteAppointment'])
    ->name('appointment-details.delete');
  Route::post('/doctor-list/data', [AdminController::class, 'getDoctorListData'])->name('doctor-list.data');
  Route::get('/doctor-list/export/csv', [AdminController::class, 'exportDoctorsCSV'])->name('doctor-list.export.csv');
  Route::get('/doctor-list/export/pdf', [AdminController::class, 'exportDoctorsPDF'])->name('doctor-list.export.pdf');
  Route::get('/doctor-list/export/excel', [AdminController::class, 'exportDoctorsExcel'])->name('doctor-list.export.excel');
  Route::post('/patient-list/data', [AdminController::class, 'getPatientListData'])->name('patient-list.data');
  Route::get('/patient-list/export/csv', [AdminController::class, 'exportPatientsCSV'])->name('patient-list.export.csv');
  Route::get('/patient-list/export/pdf', [AdminController::class, 'exportPatientsPDF'])->name('patient-list.export.pdf');
  Route::get('/patient-list/export/excel', [AdminController::class, 'exportPatientsExcel'])->name('patient-list.export.excel');
});


// Language Switch
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::middleware([
  // 'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
])->group(function () {
  Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
  })->name('dashboard');
});
