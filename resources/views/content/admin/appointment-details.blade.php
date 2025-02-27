@extends('layouts/contentLayoutMaster')

@section('title', 'Appointment Details')

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
        <!-- <h4 class="card-title">Appointment Details</h4> -->
      </div>
      <div class="card-body">
        @if(isset($appointments) && $appointments->count() > 0)
        <div class="table-responsive">
          <table class="appointment-table">
            <thead>
              <tr>
                <th>Appointment ID</th>
                <th>Patient Name</th>
                <th>Patient Email</th>
                <th>Contact</th>
                <th>Doctor Name</th>
                <th>Specialization</th>
                <th>Consultancy Fees</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($appointments as $apt)
              <tr>
                <td>{{ $apt->aptid }}</td>
                <td>{{ $apt->patname }}</td>
                <td>{{ $apt->email }}</td>
                <td>{{ $apt->contact }}</td>
                <td>{{ $apt->docname }}</td>
                <td>{{ $apt->spec }}</td>
                <td>{{ $apt->docFees }}</td>
                <td>{{ $apt->appdate }}</td>
                <td>{{ $apt->apptime }}</td>
                <td>
                  <form action="{{ route('admin.appointment-details.delete', $apt->aptid) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
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