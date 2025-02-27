@extends('layouts/contentLayoutMaster')

@section('title', 'Book Appointment')
<style>
  /* Custom Toastr Styles */
  #toast-container>.toast {
    border-radius: 6px;
    padding: 15px 20px;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    opacity: 0.95;
    margin-bottom: 15px;
    transition: opacity 0.5s ease-in-out;
  }

  #toast-container>.toast-success {
    background-color: #28a745;
    color: #fff;
    border-left: 5px solid #218838;
  }

  #toast-container>.toast-error {
    background-color: #dc3545;
    color: #fff;
    border-left: 5px solid #c82333;
  }

  #toast-container>.toast-warning {
    background-color: #ffc107;
    color: #212529;
    border-left: 5px solid #e0a800;
  }

  #toast-container>.toast-info {
    background-color: #17a2b8;
    color: #fff;
    border-left: 5px solid #138496;
  }
</style>

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <!-- <h4 class="card-title">Book New Appointment</h4> -->
      </div>
      <div class="card-body">
        <form id="appointmentForm" class="form" action="{{ route('patient.appointments.store') }}" method="POST">
          @csrf
          <div class="row mb-1">
            <div class="col-md-6">
              <label class="form-label" for="spec">Specialization</label>
              <select class="form-select" id="spec" name="spec" required>
                <option value="">Select Specialization</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="doctor">Doctor</label>
              <select class="form-select" id="doctor" name="did" required disabled>
                <option value="">Select Doctor</option>
              </select>
            </div>
          </div>

          <div class="row mb-1">
            <div class="col-md-6">
              <label class="form-label">Consultancy Fees</label>
              <input type="text" class="form-control" id="docFees" name="docFees" readonly>
            </div>
          </div>

          <div class="row mb-1">
            <div class="col-md-6">
              <label class="form-label">Appointment Date</label>
              <input type="text" id="appdate" name="appdate" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Appointment Time</label>
              <input type="text" id="apptime" name="apptime" class="form-control flatpickr-time" placeholder="HH:MM" required>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-12">
              <button type="submit" class="btn btn-primary me-1">Book Appointment</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
<script>
  $(function() {
    'use strict';

    // Initialize flatpickr date & time pickers
    $('.flatpickr-basic').flatpickr({
      minDate: "today"
    });
    $('.flatpickr-time').flatpickr({
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i"
    });

    // Initialize select2 for specialization and doctor dropdowns
    $('#spec, #doctor').select2();

    // Load Specializations
    $.ajax({
      url: '{{ route("patient.get-appointment-data") }}',
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        type: 'specializations'
      },
      success: function(data) {
        var specSelect = $('#spec');
        data.forEach(function(spec) {
          specSelect.append(new Option(spec, spec));
        });
      },
      error: function() {
        toastr.error('Error loading specializations', 'Error!');
      }
    });

    // When specialization changes, load doctors
    $('#spec').on('change', function() {
      var spec = $(this).val();
      var doctorSelect = $('#doctor');
      if (spec) {
        $.ajax({
          url: '{{ route("patient.get-appointment-data") }}',
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            type: 'doctors',
            spec: spec
          },
          success: function(data) {
            doctorSelect.empty().prop('disabled', false);
            doctorSelect.append(new Option('Select Doctor', ''));
            data.forEach(function(doctor) {
              doctorSelect.append(new Option(doctor.docname, doctor.did));
            });
          },
          error: function() {
            toastr.error('Error loading doctors', 'Error!');
          }
        });
      } else {
        doctorSelect.empty().prop('disabled', true);
        $('#docFees').val('');
      }
    });

    // When doctor changes, load consultancy fees
    $('#doctor').on('change', function() {
      var did = $(this).val();
      if (did) {
        $.ajax({
          url: '{{ route("patient.get-appointment-data") }}',
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            type: 'fees',
            did: did
          },
          success: function(data) {
            console.log("Fees response:", data);
            if (data && typeof data.docFees !== 'undefined') {
              $('#docFees').val(data.docFees);
            } else {
              $('#docFees').val('');
              toastr.error('Fees not found in response', 'Error!');
            }
          },
          error: function(xhr, status, error) {
            console.error("Error fetching fees:", xhr.responseText);
            $('#docFees').val('');
            toastr.error('Error loading fees', 'Error!');
          }
        });
      } else {
        $('#docFees').val('');
      }
    });

    // Form submission via AJAX to book appointment
    $('#appointmentForm').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: '{{ route("patient.appointments.store") }}',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          if (response.success) {
            toastr.success(response.message, 'Success!');

            $('#appointmentForm')[0].reset();
            $('#doctor').empty().prop('disabled', true);
            $('#spec').val('').trigger('change');
          } else {
            toastr.error(response.message, 'Error!');
          }
        },
        error: function(xhr) {
          var errorMessage = "Something went wrong!";
          if (xhr.responseJSON && xhr.responseJSON.errors) {
            errorMessage = Object.values(xhr.responseJSON.errors).flat().join("\n");
          }
          toastr.error(errorMessage, 'Error!');
        }
      });
    });
  });
</script>
@endsection