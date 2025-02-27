@extends('layouts/contentLayoutMaster')

@section('title', 'Prescription')
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
        <h4 class="card-title">Prescription</h4>
      </div>
      <div class="card-body">
        <form id="prescriptionForm" class="form" action="{{ route('doctor.prescription.store') }}" method="POST">
          @csrf
          <!-- Hidden fields for appointment details -->
          <input type="hidden" name="aptid" value="{{ $appointment->aptid }}">
          <input type="hidden" name="pid" value="{{ $appointment->pid }}">
          <input type="hidden" name="patname" value="{{ $appointment->patname }}">
          <input type="hidden" name="appdate" value="{{ $appointment->appdate }}">
          <input type="hidden" name="apptime" value="{{ \Carbon\Carbon::parse($appointment->apptime)->format('H:i') }}">

          <div class="row mb-1">
            <div class="col-md-6">
              <label for="disease" class="form-label">Disease</label>
              <input type="text" class="form-control" id="disease" name="disease" placeholder="Enter the disease" required>
            </div>
          </div>

          <div class="row mb-1">
            <div class="col-md-6">
              <label for="allergies" class="form-label">Allergies</label>
              <input type="text" class="form-control" id="allergies" name="allergies" placeholder="Enter any allergies" required>
            </div>
          </div>

          <div class="row mb-1">
            <div class="col-md-6">
              <label for="prescription" class="form-label">Prescription</label>
              <textarea class="form-control" id="prescription" name="prescription" rows="3" required placeholder="Enter prescription details..."></textarea>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-12">
              <button type="submit" class="btn btn-primary me-1">Submit Prescription</button>
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
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
<!-- Ensure jQuery is loaded; if already in your layout, you can remove duplicate inclusion -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function() {
    // Toastr configuration
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };

    // Handle prescription form submission via AJAX
    $('#prescriptionForm').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '{{ route("doctor.prescription.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          toastr.success('Prescription submitted successfully!', 'Success!');
          $('#prescriptionForm')[0].reset();
        },
        error: function(xhr) {
          var errorMessage = "Something went wrong!";
          if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMessage = xhr.responseJSON.message;
          }
          toastr.error(errorMessage, 'Error!');
        }
      });
    });
  });
</script>
@endsection