@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<div class="auth-wrapper auth-cover">
  <div class="auth-inner row m-0">
    <!--Brand logo-->
    <a class="brand-logo" href="#">
      <h2 class="brand-text text-primary ms-1">Elitecare Hospital</h2>
    </a>

    <!--Brand logo-->

    <!--Left Text-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        @if($configData['theme'] === 'dark')
        <img class="img-fluid" src="{{asset('images/pages/login-v2-dark.svg')}}" alt="Login V2" />
        @else
        <img class="img-fluid" src="{{asset('images/pages/login-v2.svg')}}" alt="Login V2" />
        @endif
      </div>
    </div>
    <!--Left Text-->

    <!--Login-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h2 class="card-title fw-bold mb-1">Welcome to Elitecare Hospital 👋</h2>
        <p class="card-text mb-2">Please sign-in to your account and start accessing the system</p>
        <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST" id="loginForm">
          @csrf
          <div class="mb-1">
            <select id="role" name="role" class="form-select" required>
              <option value="" disabled selected>Select role</option>
              <option value="admin">Admin</option>
              <option value="doctor">Doctor</option>
              <option value="patient">Patient</option>
            </select>
          </div>
          <div class="mb-1">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" placeholder="john@example.com" aria-describedby="email" autofocus tabindex="1" required />
          </div>
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">Password</label>
              <a href="{{url('auth/forgot-password-cover')}}">
                <small>Forgot Password?</small>
              </a>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="2" required />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
              <label class="form-check-label" for="remember-me"> Remember Me</label>
            </div>
          </div>
          <button class="btn btn-primary w-100" type="submit" tabindex="4">Sign in</button>
        </form>
        <p class="text-center mt-2">
          <span>New on our platform?</span>
          <a href="{{ route('register') }}"><span>&nbsp;Create an account</span></a>
        </p>
        <div class="divider my-2">
          <div class="divider-text">or</div>
        </div>
        <div class="auth-footer-btn d-flex justify-content-center">
          <a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a>
          <a class="btn btn-twitter white" href="#"><i data-feather="twitter"></i></a>
          <a class="btn btn-google" href="#"><i data-feather="mail"></i></a>
          <a class="btn btn-github" href="#"><i data-feather="github"></i></a>
        </div>
      </div>
    </div>
    <!-- /Login-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-login.js'))}}"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#loginForm").submit(function(event) {
      event.preventDefault();
      var formData = $(this).serialize();
      var token = $('input[name="_token"]').val();

      $.ajax({
        url: "{{ route('login') }}",
        type: "POST",
        data: formData,
        headers: {
          'X-CSRF-TOKEN': token
        },
        beforeSend: function() {
          $(".btn-primary").prop("disabled", true).text("Processing...");
        },
        success: function(response) {
          if (response.status === "success") {
            Swal.fire({
              title: "Success!",
              text: response.message,
              icon: "success",
              confirmButtonText: "OK"
            }).then(() => {
              window.location.href = "{{ url('home') }}";
              // window.location.href = response.redirect;

            });
          } else {
            Swal.fire({
              title: "Error!",
              text: response.message,
              icon: "error",
              confirmButtonText: "Try Again"
            });
          }
        },
        error: function(xhr) {
          var errorMessage = "An error occurred. Please try again.";
          if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMessage = xhr.responseJSON.message;
          }
          Swal.fire({
            title: "Error!",
            text: errorMessage,
            icon: "error",
            confirmButtonText: "Try Again"
          });
        },
        complete: function() {
          $(".btn-primary").prop("disabled", false).text("Sign in");
        }
      });
    });
  });
</script>
@endsection