@extends('layouts/contentLayoutMaster')

@section('title', 'Prescription List')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('page-style')
<style>
  /* Custom table styling */
  .appointment-table {
    width: 100%;
    border-collapse: collapse;
  }

  .appointment-table th,
  .appointment-table td {
    border: 1px solid #dee2e6;
    padding: 12px;
    text-align: left;
  }

  .appointment-table th {
    background-color: #f8f9fa;
    color: #495057;
  }

  .appointment-table tbody tr:nth-child(even) {
    background-color: #f1f1f1;
  }

  .modal-body-info {
    margin-bottom: 10px;
  }
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Prescription List</h4>
      </div>
      <div class="card-body">
        @if(isset($prescriptions) && $prescriptions->count() > 0)
        <div class="table-responsive">
          <table class="appointment-table">
            <thead>
              <tr>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Appointment ID</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Disease</th>
                <th>Allergies</th>
                <th>Doctor Name</th>
                <th>Prescription</th>
              </tr>
            </thead>
            <tbody>
              @foreach($prescriptions as $prescription)
              <tr>
                <td>{{ $prescription->pid }}</td>
                <td>{{ $prescription->patname }}</td>
                <td>{{ $prescription->aptid }}</td>
                <td>{{ $prescription->appdate }}</td>
                <td>{{ $prescription->apptime }}</td>
                <td>{{ $prescription->disease }}</td>
                <td>{{ $prescription->allergies }}</td>
                <td>{{ $prescription->docname }}</td>
                <td>
                  <button type="button"
                    class="btn btn-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#prescriptionModal{{ $prescription->aptid }}">
                    View Details
                  </button>
                </td>
              </tr>

              <!-- Modal for each prescription -->
              <div class="modal fade" id="prescriptionModal{{ $prescription->aptid }}" tabindex="-1" aria-labelledby="prescriptionModalLabel{{ $prescription->aptid }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="prescriptionModalLabel{{ $prescription->aptid }}">
                        Prescription Details - Appointment #{{ $prescription->aptid }}
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <!-- Patient Information -->
                        <div class="col-md-6 modal-body-info">
                          <h6 class="text-primary">Patient Information</h6>
                          <label><strong>Patient ID:</strong></label>
                          <p>{{ $prescription->pid }}</p>
                          <label><strong>Patient Name:</strong></label>
                          <p>{{ $prescription->patname }}</p>
                        </div>

                        <!-- Doctor Information -->
                        <div class="col-md-6 modal-body-info">
                          <h6 class="text-primary">Doctor Information</h6>
                          <label><strong>Doctor Name:</strong></label>
                          <p>{{ $prescription->docname }}</p>
                        </div>

                        <!-- Appointment Details -->
                        <div class="col-md-6 modal-body-info">
                          <h6 class="text-primary">Appointment Details</h6>
                          <label><strong>Appointment ID:</strong></label>
                          <p>{{ $prescription->aptid }}</p>
                          <label><strong>Date:</strong></label>
                          <p>{{ $prescription->appdate }}</p>
                          <label><strong>Time:</strong></label>
                          <p>{{ $prescription->apptime }}</p>
                        </div>

                        <!-- Medical Information -->
                        <div class="col-md-6 modal-body-info">
                          <h6 class="text-primary">Medical Information</h6>
                          <label><strong>Disease:</strong></label>
                          <p>{{ $prescription->disease }}</p>
                          <label><strong>Allergies:</strong></label>
                          <p>{{ $prescription->allergies }}</p>
                          <label><strong>Prescription:</strong></label>
                          <p>{{ $prescription->prescription }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="alert alert-warning">No prescriptions found.</div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
@endsection

@section('page-script')
<script>
  $(document).ready(function() {
    $('.appointment-table').DataTable({
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true
    });
  });
</script>
@endsection