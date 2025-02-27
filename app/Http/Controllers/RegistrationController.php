<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient;

class RegistrationController extends Controller
{
  public function register(Request $request)
  {
    $request->validate([
      'username' => 'required|max:50',
      'email' => 'required|email|unique:patreg,email',
      'password' => 'required|min:6|confirmed',
      'contact' => 'required|digits:10',
    ]);

    Patient::create([
      'session_id' => session()->getId(),
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'contact' => $request->contact,
      'role' => 'patient',
    ]);

    return response()->json([
      'status' => 'success',
      'message' => 'Patient registered successfully!'
    ], 200);
  }
}
