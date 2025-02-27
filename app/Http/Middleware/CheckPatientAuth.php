<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckPatientAuth
{
  public function handle(Request $request, Closure $next)
  {
    // Debug line to check if we're hitting this middleware
    Log::info('CheckPatientAuth middleware hit');

    if (!Auth::guard('patient')->check()) {
      Log::info('Patient not authenticated');
      if ($request->ajax()) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
      }
      return redirect()->route('login');
    }

    // Debug line to check authenticated patient
    Log::info('Authenticated patient: ' . Auth::guard('patient')->user()->username);

    return $next($request);
  }
}
