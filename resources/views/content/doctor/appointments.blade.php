@extends('layouts/contentLayoutMaster')

@section('title', 'Patient Appointments')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('page-style')
<style>
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

  .appointment-status-success {
    color: #28a745;
    font-weight: bold;
  }

  .appointment-status-pending {
    color: #ffc107;
    font-weight: bold;
  }

  .appointment-status-cancelled {
    color: #dc3545;
    font-weight: bold;
  }
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Patient Appointments</h4>
      </div>
      <div class="card-body">
        @if(isset($appointments) && $appointments->count() > 0)
        <div class="table-responsive">
          <table class="appointment-table">
            <thead>
              <tr>
                <th>Patient ID</th>
                <th>Appointment ID</th>
                <th>Patient Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Current Status</th>
                <th>Cancel</th>
                <th>Prescribe</th>
              </tr>
            </thead>
            <tbody>
              @foreach($appointments as $appointment)
              <tr>
                <td>{{ $appointment->pid }}</td>
                <td>{{ $appointment->aptid }}</td>
                <td>{{ $appointment->patname }}</td>
                <td>{{ $appointment->email }}</td>
                <td>{{ $appointment->contact }}</td>
                <td>{{ $appointment->appdate }}</td>
                <td>{{ $appointment->apptime }}</td>
                <td>
                  @if($appointment->userStatus == 0 && $appointment->doctorStatus == 0)
                  <span class="appointment-status-cancelled">Cancelled by Doctor</span>
                  @elseif($appointment->userStatus == 0 && $appointment->doctorStatus == 1)
                  <span class="appointment-status-cancelled">Cancelled by Patient</span>
                  @else
                  <span class="appointment-status-success">Active</span>
                  @endif
                </td>
                <td>
                  <form action="{{ route('doctor.appointments.cancel', $appointment->aptid) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                  </form>
                </td>
                <td>
                  <a href="{{ route('doctor.prescription.create', $appointment->aptid) }}" class="btn btn-primary btn-sm">Prescribe</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="alert alert-warning">No appointments found.</div>
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