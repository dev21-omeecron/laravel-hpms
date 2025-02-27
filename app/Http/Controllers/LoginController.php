<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function showLoginForm()
  {
    if (Auth::guard('admin')->check() || Auth::guard('doctor')->check() || Auth::guard('patient')->check()) {
      return redirect()->route('home');
    }

    return view('content.auth.login');
  }

  public function login(Request $request)
  {
    $request->validate([
      'role' => 'required|in:admin,doctor,patient',
      'email' => 'required|email',
      'password' => 'required|min:6',
    ]);

    $role = $request->role;
    $guards = [
      'admin' => 'admin',
      'doctor' => 'doctor',
      'patient' => 'patient',
    ];

    if (!isset($guards[$role])) {
      return response()->json(['status' => 'error', 'message' => 'Invalid role selected.'], 400);
    }

    $credentials = [
      'email' => $request->email,
      'password' => $request->password,
    ];

    if (Auth::guard($guards[$role])->attempt($credentials)) {
      $request->session()->regenerate();
      $request->session()->put('role', $role);

      $userModel = [
        'admin' => \App\Models\Admin::class,
        'doctor' => \App\Models\Doctor::class,
        'patient' => \App\Models\Patient::class,
      ][$role];

      $user = $userModel::where('email', $request->email)->first();
      if ($user) {
        $user->session_id = session()->getId();
        $user->save();
        Log::info("Logged in user: " . $user->email . " with role: " . $role . " and session_id: " . $user->session_id);
      }

      return response()->json([
        'status' => 'success',
        'message' => 'Login successful!',
        'redirect' => url('/home')
      ]);
    }

    return response()->json(['status' => 'error', 'message' => 'Invalid credentials for selected role.'], 401);
  }

  public function logout(Request $request)
  {
    $guards = ['admin', 'doctor', 'patient'];

    foreach ($guards as $guard) {
      if (Auth::guard($guard)->check()) {
        Auth::guard($guard)->logout();
      }
    }

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
  }
}
