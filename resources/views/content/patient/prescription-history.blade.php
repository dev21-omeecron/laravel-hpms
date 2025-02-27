@extends('layouts/contentLayoutMaster')

@section('title', 'Prescription History')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('page-style')
<style>
  .prescription-table {
    width: 100%;
    border-collapse: collapse;
  }

  .prescription-table th,
  .prescription-table td {
    border: 1px solid #dee2e6;
    padding: 12px;
    text-align: left;
  }

  .prescription-table th {
    background-color: #f8f9fa;
    color: #495057;
  }

  .prescription-table tbody tr:nth-child(even) {
    background-color: #f1f1f1;
  }

  .status-paid {
    color: #28a745;
    font-weight: bold;
  }

  .status-unpaid {
    color: #dc3545;
    font-weight: bold;
  }

  .modal-body-info {
    margin-bottom: 1.5rem;
  }

  .modal-body-info label {
    font-weight: bold;
    margin-bottom: 0.5rem;
  }

  .modal-body-info p {
    margin-bottom: 0.5rem;
    padding: 0.5rem;
    background-color: #f8f9fa;
    border-radius: 4px;
  }

  /* Styling for Bill Pay Modal */
  .bill-modal .form-label {
    font-weight: 500;
    color: #333;
  }

  .bill-modal .form-control,
  .bill-modal .form-select {
    border-radius: 5px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
  }

  .bill-modal .btn-primary {
    background-color: #007bff;
    border: none;
    padding: 10px 20px;
  }

  .bill-modal .btn-primary:hover {
    background-color: #0056b3;
  }
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Prescription History</h4>
      </div>
      <div class="card-body">
        @if(isset($prescriptions) && count($prescriptions) > 0)
        <div class="table-responsive">
          <table class="prescription-table">
            <thead>
              <tr>
                <th>Appointment ID</th>
                <th>Doctor Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Disease</th>
                <th>Allergies</th>
                <th>Prescription</th>
                <th>Bill Payment</th>
                <th>Invoice</th>
              </tr>
            </thead>
            <tbody>
              @foreach($prescriptions as $prescription)
              <tr>
                <td>{{ $prescription->aptid }}</td>
                <td>{{ $prescription->docname }}</td>
                <td>{{ $prescription->appdate }}</td>
                <td>{{ $prescription->apptime }}</td>
                <td>{{ $prescription->disease }}</td>
                <td>{{ $prescription->allergies }}</td>
                <td>
                  <button type="button"
                    class="btn btn-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#prescriptionModal{{ $prescription->aptid }}">
                    View Details
                  </button>
                </td>
                <td>
                  @if($prescription->is_paid)
                  <span class="status-paid">Paid</span>
                  @else
                  <button type="button"
                    class="btn btn-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#billModal{{ $prescription->aptid }}">
                    Bill Pay
                  </button>
                  @endif
                </td>
                <td>
                  <a href="{{ route('patient.prescription.invoice', $prescription->aptid) }}" class="btn btn-success btn-sm" target="_blank">View</a>
                </td>
              </tr>

              <!-- Prescription Details Modal (Unchanged) -->
              <div class="modal fade" id="prescriptionModal{{ $prescription->aptid }}" tabindex="-1" aria-labelledby="prescriptionModalLabel{{ $prescription->aptid }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="prescriptionModalLabel{{ $prescription->aptid }}">
                        Prescription Details - Appointment #{{ $prescription->aptid }}
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6 modal-body-info">
                          <h6 class="text-primary">Patient Information</h6>
                          <label>Patient ID:</label>
                          <p>{{ $prescription->pid }}</p>
                          <label>Patient Name:</label>
                          <p>{{ $prescription->patname }}</p>
                        </div>
                        <div class="col-md-6 modal-body-info">
                          <h6 class="text-primary">Doctor Information</h6>
                          <label>Doctor Name:</label>
                          <p>{{ $prescription->docname }}</p>
                        </div>
                        <div class="col-md-6 modal-body-info">
                          <h6 class="text-primary">Appointment Details</h6>
                          <label>Date:</label>
                          <p>{{ $prescription->appdate }}</p>
                          <label>Time:</label>
                          <p>{{ $prescription->apptime }}</p>
                        </div>
                        <div class="col-md-6 modal-body-info">
                          <h6 class="text-primary">Medical Information</h6>
                          <label>Disease:</label>
                          <p>{{ $prescription->disease }}</p>
                          <label>Allergies:</label>
                          <p>{{ $prescription->allergies }}</p>
                        </div>
                        <div class="col-12 modal-body-info">
                          <h6 class="text-primary">Prescription</h6>
                          <label>Medications & Instructions:</label>
                          <p>{{ $prescription->prescription }}</p>
                        </div>
                        <div class="col-12 modal-body-info">
                          <h6 class="text-primary">Payment Status</h6>
                          <label>Payment Status:</label>
                          <p>
                            @if($prescription->is_paid)
                            <span class="status-paid">Paid via {{ $prescription->payment_method }}</span>
                            @else
                            <span class="status-unpaid">Unpaid</span>
                            @endif
                          </p>
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

              <!-- Bill Payment Modal -->
              <div class="modal fade bill-modal" id="billModal{{ $prescription->aptid }}" tabindex="-1" aria-labelledby="billModalLabel{{ $prescription->aptid }}" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="billModalLabel{{ $prescription->aptid }}">
                        Bill Payment - Appointment #{{ $prescription->aptid }}
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('patient.prescription.pay', $prescription->aptid) }}" method="POST">
                      @csrf
                      <div class="modal-body">
                        <!-- Appointment Information -->
                        <div class="row mb-3">
                          <div class="col-md-6 modal-body-info">
                            <h6 class="text-primary">Appointment Information</h6>
                            <label>Appointment Date</label>
                            <p>{{ $prescription->appdate }}</p>
                            <label>Appointment Time</label>
                            <p>{{ $prescription->apptime }}</p>
                            <label>Doctor Name:</label>
                            <p>{{ $prescription->docname }}</p>
                            <label>Appointment Date:</label>
                            <p>{{ $prescription->appdate }}</p>
                          </div>
                          <div class="col-md-6 modal-body-info">
                            <h6 class="text-primary">Patient Information</h6>
                            <label>Patient ID:</label>
                            <p>{{ $prescription->pid }}</p>
                            <label>Patient Name:</label>
                            <p>{{ $prescription->patname }}</p>

                          </div>
                        </div>

                        <!-- Payment Form -->
                        <div class="row">
                          <!-- Payment Method -->
                          <div class="col-md-6 mb-3">
                            <label for="payment_method{{ $prescription->aptid }}" class="form-label">Payment Method*</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror"
                              id="payment_method{{ $prescription->aptid }}"
                              name="payment_method" required>
                              <option value="">Select payment method</option>
                              <option value="Cash">Cash</option>
                              <option value="Credit Card">Credit Card</option>
                              <option value="Debit Card">Debit Card</option>
                              <option value="UPI">UPI</option>
                              <option value="Net Banking">Net Banking</option>
                            </select>
                            @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>

                          <!-- Payment Details -->
                          <div class="col-md-6 mb-3">
                            <label for="payment_details{{ $prescription->aptid }}" class="form-label">Payment Details*</label>
                            <input type="text"
                              class="form-control @error('payment_details') is-invalid @enderror"
                              id="payment_details{{ $prescription->aptid }}"
                              name="payment_details"
                              required
                              placeholder="Transaction ID/Reference Number">
                            @error('payment_details')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>

                          <!-- Billing Notes -->
                          <div class="col-12 mb-3">
                            <label for="billing_notes{{ $prescription->aptid }}" class="form-label">Billing Notes (Optional)</label>
                            <textarea class="form-control @error('billing_notes') is-invalid @enderror"
                              id="billing_notes{{ $prescription->aptid }}"
                              name="billing_notes"
                              rows="3"
                              placeholder="Enter any additional notes regarding the payment"></textarea>
                            @error('billing_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @if(!$prescription->is_paid)
                        <button type="submit" class="btn btn-primary">Submit Payment</button>
                        @endif
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="alert alert-info">
          No prescriptions found. This could be because:
          <ul class="mt-2">
            <li>No prescriptions have been written yet</li>
            <li>Your appointments haven't been completed</li>
            <li>The doctor hasn't uploaded the prescription</li>
          </ul>
        </div>
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
    $('.prescription-table').DataTable({
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