<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient;

class PatregController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'username' => 'required|max:50',
      'email' => 'required|email|unique:patreg,email',
      'contact' => 'required|digits:10',
      'password' => 'required|min:6',
    ]);

    Patient::create([
      'session_id' => session()->getId(),
      'username' => $request->username,
      'email' => $request->email,
      'contact' => $request->contact,
      'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'Registration successful']);
  }
}
