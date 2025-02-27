@extends('layouts/contentLayoutMaster')

@section('title', 'Home')

@section('content')
@php
$user = null;
if (Auth::guard('patient')->check()) {
$user = Auth::guard('patient')->user();
$role = 'patient';
} elseif (Auth::guard('doctor')->check()) {
$user = Auth::guard('doctor')->user();
$role = 'doctor';
} elseif (Auth::guard('admin')->check()) {
$user = Auth::guard('admin')->user();
$role = 'admin';
}
$name = $user ? $user->username : 'Guest';
@endphp

<div class="card">
  <div class="card-header">
  </div>
  <div class="card-body">
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="card card-congratulations">
        <div class="card-body text-center">
          <img
            src="{{asset('images/elements/decore-left.png')}}"
            class="congratulations-img-left"
            alt="card-img-left" />
          <img
            src="{{asset('images/elements/decore-right.png')}}"
            class="congratulations-img-right"
            alt="card-img-right" />
          <div class="avatar avatar-xl bg-primary shadow">
            <div class="avatar-content">
              <i data-feather="award" class="font-large-1"></i>
            </div>
          </div>
          <div class="text-center">
            <h1 class="mb-1 text-white">Welcome {{ $name }}</h1>
            <p class="card-text m-auto w-75">
            <h4 class="text-white">
              @if($role == 'patient')
              Here you can access the system and book doctor appointment and many more...
              @elseif($role == 'doctor')
              Here you can manage your appointments and patients...
              @else
              Here you can manage the entire system...
              @endif
            </h4>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection