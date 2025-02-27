<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
  /**
   * Display the change password form.
   *
   * @return \Illuminate\View\View
   */
  public function showChangePasswordForm()
  {
    if (Auth::guard('admin')->check()) {
      $user = Auth::guard('admin')->user();
    } elseif (Auth::guard('doctor')->check()) {
      $user = Auth::guard('doctor')->user();
    } elseif (Auth::guard('patient')->check()) {
      $user = Auth::guard('patient')->user();
    } else {
      $user = null;
    }

    return view('content.auth.change-password', compact('user'));
  }

  /**
   * Handle the change password request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updatePassword(Request $request)
  {
    $request->validate([
      'password' => 'required|string|min:6|confirmed',
    ], [
      'password.confirmed' => 'The new password confirmation does not match.',
    ]);

    // Dynamically get the authenticated user
    if (Auth::guard('admin')->check()) {
      $user = Auth::guard('admin')->user();
    } elseif (Auth::guard('doctor')->check()) {
      $user = Auth::guard('doctor')->user();
    } elseif (Auth::guard('patient')->check()) {
      $user = Auth::guard('patient')->user();
    } else {
      return redirect()->route('login')->with('error', 'User not authenticated.');
    }

    // Update the user's password using bcrypt
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('home')->with('success', 'Password changed successfully.');
  }
}
