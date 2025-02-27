<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice - Appointment #{{ $prescription->aptid }}</title>
  <style>
    /* Reset and Base Styles */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #ffffff;
      color: #333;
      line-height: 1.4;
    }

    /* Invoice Container */
    .invoice-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 15px;
      /* Reduced from 20px */
      border-radius: 8px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      border: 1px solid #e9ecef;
    }

    /* Header Styling */
    .invoice-header {
      text-align: center;
      padding: 10px 0;
      /* Reduced from 15px */
      background: linear-gradient(135deg, #007bff, #004d99);
      /* Kept gradient for accent, but visible */
      border-radius: 6px 6px 0 0;
      margin: -15px -15px 15px -15px;
      /* Adjusted to match padding */
      box-shadow: 0 2px 8px rgba(0, 77, 153, 0.15);
    }

    .invoice-header h1 {
      font-size: 22px;
      /* Reduced from 24px for compactness */
      font-weight: bold;
      color: #000000;
      /* Changed to black for better visibility */
      text-transform: uppercase;
      margin: 0;
      text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);
    }

    .invoice-header p {
      font-size: 12px;
      /* Reduced from 14px */
      color: #ffffff;
      /* Changed to white for contrast with black hospital name */
      margin-top: 5px;
      font-weight: 500;
    }

    /* Hospital Intro Section */
    .hospital-intro {
      text-align: center;
      margin-bottom: 10px;
      /* Reduced from 15px */
      font-size: 12px;
      /* Reduced from 14px */
      color: #555;
      line-height: 1.5;
      background-color: #f8f9fa;
      padding: 8px;
      /* Reduced from 10px */
      border-radius: 5px;
      border: 1px solid #e9ecef;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
    }

    /* Section Styling */
    .section {
      margin-bottom: 10px;
      /* Reduced from 15px */
      padding: 8px;
      /* Reduced from 10px */
      background-color: #f8f9fa;
      border-radius: 5px;
      border: 1px solid #e9ecef;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
    }

    .section h2 {
      font-size: 14px;
      /* Reduced from 16px */
      color: #004d99;
      margin-bottom: 8px;
      /* Reduced from 10px */
      font-weight: 600;
      text-transform: uppercase;
      border-bottom: 1px solid #ddd;
      padding-bottom: 4px;
      /* Reduced from 5px */
    }

    .section p {
      margin: 4px 0;
      /* Reduced from 5px */
      font-size: 12px;
      /* Reduced from 14px */
      color: #333;
    }

    /* Invoice Details Table */
    .invoice-details {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
      /* Reduced from 15px */
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
    }

    .invoice-details th,
    .invoice-details td {
      padding: 8px;
      /* Reduced from 10px */
      border: 1px solid #e9ecef;
      text-align: left;
      vertical-align: middle;
      font-size: 12px;
      /* Reduced from 14px */
    }

    .invoice-details th {
      background-color: #004d99;
      color: #ffffff;
      font-weight: 600;
      text-transform: uppercase;
    }

    .invoice-details tr:nth-child(even) td {
      background-color: #f8f9fa;
    }

    /* Total Amount */
    .total-amount {
      font-size: 16px;
      /* Reduced from 18px */
      text-align: right;
      margin-top: 10px;
      /* Reduced from 15px */
      font-weight: 700;
      color: #dc3545;
      background-color: #f8f9fa;
      padding: 8px;
      /* Reduced from 10px */
      border-radius: 5px;
      box-shadow: 0 1px 6px rgba(220, 53, 69, 0.08);
    }

    /* Stamp Section */
    .stamp {
      text-align: center;
      margin-top: 10px;
      /* Reduced from 15px */
      font-size: 16px;
      /* Reduced from 18px */
      font-weight: bold;
      color: #004d99;
      border: 2px dashed #004d99;
      padding: 6px;
      /* Reduced from 8px */
      width: 50%;
      margin-left: auto;
      margin-right: auto;
      border-radius: 5px;
      text-shadow: 1px 1px 1px rgba(0, 77, 153, 0.15);
    }

    /* Thank You Message */
    .thank-you {
      text-align: center;
      margin-top: 10px;
      /* Reduced from 15px */
      font-size: 14px;
      /* Reduced from 16px */
      color: #0066cc;
      font-weight: 500;
    }

    /* Signature Section */
    .signature-section {
      margin-top: 10px;
      /* Reduced from 15px */
      text-align: left;
      background-color: #f8f9fa;
      padding: 10px;
      /* Reduced from 12px */
      border-radius: 6px;
      border: 1px solid #e9ecef;
      width: 180px;
      /* Reduced from 200px */
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .signature-section p {
      font-size: 14px;
      /* Reduced from 16px */
      font-weight: bold;
      margin-top: 6px;
      /* Reduced from 8px */
      text-transform: uppercase;
      color: #004d99;
    }

    /* Footer */
    .footer {
      margin-top: 10px;
      /* Reduced from 15px */
      text-align: center;
      font-size: 10px;
      /* Reduced from 12px */
      color: #777;
      border-top: 1px solid #e9ecef;
      padding-top: 8px;
      /* Reduced from 10px */
      padding-bottom: 5px;
    }

    .footer p {
      margin: 4px 0;
      /* Reduced from 5px */
      line-height: 1.3;
      /* Reduced from 1.4 */
    }
  </style>
</head>

<body>
  <div class="invoice-container">
    <div class="invoice-header">
      <h1>Elitecare Hospital</h1>
      <p>Healthcare Excellence for You</p>
    </div>

    <div class="hospital-intro">
      <p>Elitecare Hospital is a premier healthcare institution committed to delivering world-class medical services. With state-of-the-art facilities, expert physicians, and compassionate care, we ensure your health and well-being are our top priorities. Our mission is to provide personalized, innovative, and accessible healthcare to the community of Surat and beyond.</p>
    </div>

    <div class="section patient-details">
      <h2>Patient Information</h2>
      <p><strong>Patient ID:</strong> {{ $prescription->pid }}</p>
      <p><strong>Patient Name:</strong> {{ $prescription->patname }}</p>
    </div>

    <div class="section appointment-details">
      <h2>Appointment Details</h2>
      <p><strong>Doctor Name:</strong> {{ $prescription->docname }}</p>
      <p><strong>Appointment Date:</strong> {{ $prescription->appdate }}</p>
      <p><strong>Appointment Time:</strong> {{ $prescription->apptime }}</p>
      <p><strong>Doctor Fees:</strong> Rs. {{ number_format($appointment->docFees ?? 0, 2) }}</p>
    </div>

    <table class="invoice-details">
      <tr>
        <th>Appointment ID</th>
        <th>Doctor Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
      </tr>
      <tr>
        <td>{{ $prescription->aptid }}</td>
        <td>{{ $prescription->docname }}</td>
        <td>{{ $prescription->appdate }}</td>
        <td>{{ $prescription->apptime }}</td>
        <td>
          @if($prescription->is_paid)
          Paid via {{ $prescription->payment_method }} ({{ $prescription->payment_details }})
          @else
          Unpaid
          @endif
        </td>
      </tr>
    </table>

    <div class="total-amount">
      <p><strong>Total Due:</strong> Rs. {{ number_format($appointment->docFees ?? 0, 2) }}</p>
    </div>

    <div class="stamp">
      ELITECARE HOSPITAL STAMP
    </div>

    <p class="thank-you">Thank you, <strong>{{ $patient->username ?? 'Guest' }}</strong></p>

    <div class="signature-section">
      <p>Mr. Jay Goyani</p>
      <p>Founder</p>
    </div>

    <div class="footer">
      <p>Elitecare Hospital | Address: 123 Health Lane, Medical City, Surat, Gujarat 395007</p>
      <p>Phone: (+91) 98765 43210 | Email: info@elitecarehospital.com | support@elitecarehospital.com</p>
    </div>
  </div>
</body>

</html>