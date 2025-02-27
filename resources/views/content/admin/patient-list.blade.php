@extends('layouts/contentLayoutMaster')

@section('title', 'Patient List')

@section('vendor-style')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<!-- Bootstrap Icons for buttons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endsection

@section('page-style')
<style>
  .card {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 77, 153, 0.1);
    border: 1px solid #e9ecef;
    background-color: #ffffff;
  }

  .card-header {
    background: linear-gradient(135deg, #007bff, #004d99);
    border-radius: 10px 10px 0 0;
    padding: 1rem 1.5rem;
    color: #ffffff;
  }

  .card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #ffffff;
    text-transform: uppercase;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);
  }

  .table-responsive {
    margin-top: 1rem;
  }

  .appointment-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
  }

  .appointment-table th,
  .appointment-table td {
    border: 1px solid #dee2e6;
    padding: 12px 15px;
    text-align: left;
    vertical-align: middle;
  }

  .appointment-table th {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    text-transform: uppercase;
    position: sticky;
    top: 0;
    z-index: 1;
  }

  .appointment-table tbody tr:nth-child(even) {
    background-color: #f9fafb;
  }

  .appointment-table tbody tr:hover {
    background-color: #e9ecef;
    transition: background-color 0.3s ease;
  }

  /* DataTables buttons styling */
  .dt-buttons {
    margin-bottom: 1rem;
  }

  .dt-button {
    margin-right: 0.5rem !important;
    margin-bottom: 0.5rem !important;
    background-color: #004d99 !important;
    border-color: #004d99 !important;
    border-radius: 5px !important;
    padding: 0.375rem 0.75rem !important;
    font-size: 0.875rem !important;
    font-weight: 500 !important;
    transition: background-color 0.3s ease, border-color 0.3s ease !important;
  }

  .dt-button:hover {
    background-color: #003d80 !important;
    border-color: #003d80 !important;
    color: #ffffff !important;
  }

  .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
  }

  .btn-danger:hover {
    background-color: #c82333;
    border-color: #c82333;
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

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .card-header .row {
      flex-direction: column;
      text-align: center;
    }

    .card-header .col-md-6.text-md-end {
      text-align: center;
      margin-top: 0.5rem;
    }

    .appointment-table th,
    .appointment-table td {
      padding: 8px 10px;
      font-size: 14px;
    }

    .dt-buttons {
      flex-direction: column;
      align-items: center;
    }

    .dt-button {
      width: 100% !important;
      margin-right: 0 !important;
    }
  }
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Patient List</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="patient-list-table" class="appointment-table table table-striped table-hover">
            <thead>
              <tr>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('vendor-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('page-script')
<script>
  $(document).ready(function() {
    console.log('Route URL: ' + "{{ route('admin.patient-list.data') }}");
    $('#patient-list-table').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      order: [
        [0, 'asc']
      ],
      columns: [{
          data: 'pid'
        },
        {
          data: 'username'
        },
        {
          data: 'email'
        },
        {
          data: 'contact'
        },
        {
          data: 'action',
          orderable: false,
          searchable: false
        }
      ],
      "ajax": {
        "url": "{{ route('admin.patient-list.data') }}",
        "type": "POST",
        "data": function(d) {
          d._token = "{{ csrf_token() }}";
          console.log('Sending AJAX request with data:', d);
        },
        "error": function(xhr, status, error) {
          console.error('AJAX Error:', error);
          console.log('Response:', xhr.responseText);
        }
      },
      dom: '<"d-flex justify-content-between align-items-center" B f>rt<"row"<"col-sm-12 col-md-5"l><"col-sm-12 col-md-7"p>>',
      buttons: [{
          extend: 'csv',
          text: '<i class="bi bi-file-earmark-arrow-down me-1"></i> Export CSV',
          className: 'btn btn-primary btn-sm',
          exportOptions: {
            columns: [0, 1, 2, 3]
          }
        },
        {
          extend: 'pdf',
          text: '<i class="bi bi-file-earmark-arrow-down me-1"></i> Export PDF',
          className: 'btn btn-primary btn-sm',
          exportOptions: {
            columns: [0, 1, 2, 3]
          },
          customize: function(doc) {
            doc.content[1].table.headerRows = 1;
            doc.content[1].table.body[0].fillColor = '#f8f9fa';
            doc.defaultStyle.fontSize = 10;
            doc.styles.tableHeader.fontSize = 12;
            doc.styles.tableHeader.color = '#ffffff';
            doc.styles.tableHeader.fillColor = '#004d99';
          }
        },
        {
          extend: 'excel',
          text: '<i class="bi bi-file-earmark-arrow-down me-1"></i> Export Excel',
          className: 'btn btn-primary btn-sm',
          exportOptions: {
            columns: [0, 1, 2, 3]
          }
        }
      ],
      language: {
        processing: "Processing...",
        search: "Search:",
        lengthMenu: "Show _MENU_ patients",
        info: "Showing _START_ to _END_ of _TOTAL_ patients",
        infoEmpty: "No patients available",
        infoFiltered: "(filtered from _MAX_ total patients)",
        zeroRecords: "No matching patients found",
        paginate: {
          first: "First",
          last: "Last",
          next: "Next",
          previous: "Previous"
        }
      },
      error: function(xhr, error, thrown) {
        console.error('DataTables Error:', error, thrown);
        console.log('Response:', xhr.responseText);
      },
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100]
    });
  });
</script>
@endsection