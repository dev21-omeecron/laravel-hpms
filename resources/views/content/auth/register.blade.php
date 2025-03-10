@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-cover">
  <div class="auth-inner row m-0">
    <!-- Brand logo-->
    <a class="brand-logo" href="#">
      <!-- <img src="{{ asset('images/logo/Elitecare_logo.png') }}" alt="Elitecare Logo" height="100"> -->
      <!-- <img src="{{ asset('images/logo/Elitecare_logo.png')}}" alt="logo" height="28"> -->
      <!-- <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="28"> -->
      <defs>
        <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
          <stop stop-color="#000000" offset="0%"></stop>
          <stop stop-color="#FFFFFF" offset="100%"></stop>
        </lineargradient>
        <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
          <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
          <stop stop-color="#FFFFFF" offset="100%"></stop>
        </lineargradient>
      </defs>
      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Artboard" transform="translate(-400.000000, -178.000000)">
          <g id="Group" transform="translate(400.000000, 178.000000)">
            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
          </g>
        </g>
      </g>
      </svg>
      <h2 class="brand-text text-primary ms-1">Elitecare Hospital</h2>
    </a>
    <!-- /Brand logo-->

    <!-- Left Text-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        @if($configData['theme'] === 'dark')
        <img class="img-fluid" src="{{asset('images/pages/register-v2-dark.svg')}}" alt="Register V2" />
        @else
        <img class="img-fluid" src="{{asset('images/pages/register-v2.svg')}}" alt="Register V2" />
        @endif
      </div>
    </div>
    <!-- /Left Text-->

    <!-- Register-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h2 class="card-title fw-bold mb-1">Adventure starts here 🚀</h2>
        <p class="card-text mb-2">Make your app management easy and fun!</p>
        <form class="auth-register-form mt-2" action="{{ route('register') }}" method="POST">
          @csrf
          <div class="mb-1">
            <label class="form-label" for="register-username">Username</label>
            <input class="form-control" id="register-username" type="text" name="username" placeholder="johndoe" aria-describedby="register-username" autofocus="" tabindex="1" />
          </div>
          <div class="mb-1">
            <label class="form-label" for="register-email">Email</label>
            <input class="form-control" id="register-email" type="email" name="email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2" />
          </div>
          <div class="mb-1">
            <label class="form-label" for="register-password">Password</label>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="register-password" type="password" name="password" placeholder="············" aria-describedby="register-password" tabindex="3" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <div class="mb-1">
            <label class="form-label" for="register-password-confirmation">Confirm Password</label>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="register-password-confirmation" type="password" name="password_confirmation" placeholder="············" aria-describedby="register-password-confirmation" tabindex="3" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <div class="mb-1">
            <label class="form-label" for="register-phone">Phone Number</label>
            <div class="input-group input-group-merge form-mobile-toggle">
              <span class="input-group-text cursor-pointer"><i data-feather="smartphone"></i></span>
              <input class="form-control phone-number-mask" id="register-phone" type="number" name="contact" placeholder="+1 (123) 456 7890" aria-describedby="register-phone" tabindex="3" />
            </div>
          </div>

          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" id="register-privacy-policy" type="checkbox" tabindex="4" />
              <label class="form-check-label" for="register-privacy-policy">I agree to<a href="#">&nbsp;privacy policy & terms</a></label>
            </div>
          </div>
          <button class="btn btn-primary w-100" tabindex="5">Sign up</button>
        </form>
        <p class="text-center mt-2">
          <span>Already have an account?</span>
          <a href="{{ route('login') }}"><span>&nbsp;Sign in instead</span></a>
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
    <!-- /Register-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/auth-register.js')}}"></script>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function() {
    $(".auth-register-form").submit(function(event) {
      event.preventDefault();

      var formData = $(this).serialize();

      $.ajax({
        url: "{{ route('register') }}",
        type: "POST",
        data: formData,
        beforeSend: function() {
          $(".btn-primary").prop("disabled", true).text("Processing...");
        },
        success: function(response) {
          console.log(response);
          if (response.status === "success") {
            Swal.fire({
              title: "Registration Successful!",
              text: response.message,
              icon: "success",
              confirmButtonText: "Go to Login"
            }).then(() => {
              window.location.href = "{{ route('login') }}";
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
          var errors = xhr.responseJSON?.errors;
          var errorMessage = "Something went wrong!";

          if (errors) {
            errorMessage = Object.values(errors).flat().join("\n");
          }

          Swal.fire({
            title: "Validation Error!",
            text: errorMessage,
            icon: "warning"
          });
        },
        complete: function() {
          $(".btn-primary").prop("disabled", false).text("Sign up");
        }
      });
    });
  });
</script>