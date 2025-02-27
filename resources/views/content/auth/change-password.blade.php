@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/contentLayoutMaster')

@section('title', 'Change Password')

@section('vendor-style')
<!-- Vendor CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('page-style')
<!-- Enhanced Page CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
<style>
  .auth-card {
    max-width: 700px;
    /* Wider form */
    margin: 0 auto;
    border-radius: 12px;
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
    border: none;
    background: #fff;
  }

  .form-label {
    font-weight: 500;
    color: #333;
  }

  .form-control {
    border-radius: 8px;
    padding: 0.75rem 1.25rem;
    transition: all 0.2s ease;
  }

  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
  }

  .is-invalid {
    border-color: #dc3545 !important;
  }

  .invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 0.875em;
    margin-top: 0.25rem;
  }

  .btn-primary {
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.2s ease;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
  }

  .back-link {
    color: #666;
    transition: color 0.2s ease;
  }

  .back-link:hover {
    color: #007bff;
    text-decoration: none;
  }

  .input-group-text {
    border-radius: 8px;
    background: #f8f9fa;
    border-color: #dee2e6;
  }

  /* Removed vertical centering, align card to top */
  .authentication-wrapper {
    min-height: auto;
    /* Removed to prevent vertical centering */
    padding-top: 1rem;
    /* Small top padding */
    padding-bottom: 2rem;
    /* Ensure bottom spacing */
  }

  /* Reduced spacing for header section */
  .card-body {
    padding-top: 1.5rem;
    /* Reduced from 2rem */
  }

  .app-brand {
    margin-bottom: 1rem !important;
    /* Tightened gap below logo */
  }

  .header-text {
    margin-bottom: 1.5rem !important;
    /* Reduced gap below heading */
  }
</style>
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/pages-auth.js') }}"></script>
@endsection

@section('content')
<div class="container-fluid">
  <div class="authentication-wrapper">
    <div class="authentication-inner">
      <!-- Wider Reset Password Card -->
      <div class="card auth-card p-3 p-md-4"> <!-- Slightly reduced padding -->
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-3">
            <a href="{{ url('/') }}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                {{-- @include('_partials.macros', ['height' => 20, 'withbg' => "fill: #fff;"]) --}}
              </span>
              <span class="app-brand-text demo text-body fw-bold ms-1 text-uppercase">
                {{ config('variables.templateName') }}
              </span>
            </a>
          </div>
          <!-- /Logo -->

          <div class="text-center header-text">
            <h3 class="mb-1">Reset Your Password 🔒</h3>
            <p class="text-muted mb-0">Enter a new password for <b><span class="fw-medium">{{ $user->email ?? '' }}</span></b></p>
          </div>

          <form id="formAuthentication" action="{{ route('change-password.update') }}" method="POST">
            @csrf

            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">New Password</label>
              <div class="input-group input-group-merge">
                <input
                  type="password"
                  id="password"
                  class="form-control @error('password') is-invalid @enderror"
                  name="password"
                  placeholder="••••••••"
                  aria-describedby="password"
                  required />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
              @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password_confirmation">Confirm Password</label>
              <div class="input-group input-group-merge">
                <input
                  type="password"
                  id="password_confirmation"
                  class="form-control @error('password_confirmation') is-invalid @enderror"
                  name="password_confirmation"
                  placeholder="••••••••"
                  aria-describedby="password"
                  required />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
              @error('password_confirmation')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <button class="btn btn-primary d-grid w-100 mb-3" type="submit">
              Update Password
            </button>

            <div class="text-center">
              <a href="{{ route('login') }}" class="back-link d-flex align-items-center justify-content-center gap-1">
                <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                Back to Login
              </a>
            </div>
          </form>
        </div>
      </div>
      <!-- /Reset Password Card -->
    </div>
  </div>
</div>
@endsection