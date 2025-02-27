<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorRegistrationController extends Controller
{
  public function register(Request $request)
  {
    $request->validate([
      'docname' => 'required|max:50',
      'email' => 'required|email|unique:doctreg,email',
      'password' => 'required|min:6|confirmed',
      'contact' => 'required|digits:10',
      'spec' => 'required|max:50',
      'docFees' => 'required|numeric',
    ]);

    Doctor::create([
      'session_id' => session()->getId(),
      'docname' => $request->docname,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'contact' => $request->contact,
      'spec' => $request->spec,
      'docFees' => $request->docFees,
    ]);

    return response()->json([
      'status' => 'success',
      'message' => 'Doctor registered successfully!'
    ], 200);
  }
}
