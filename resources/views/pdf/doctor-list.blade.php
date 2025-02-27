<html>

<head>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid black;
      padding: 5px;
    }

    th {
      background-color: #f8f9fa;
    }
  </style>
</head>

<body>
  <table>
    <tr>
      <th>Doctor ID</th>
      <th>Doctor Name</th>
      <th>Doctor Email</th>
      <th>Contact</th>
      <th>Specialization</th>
      <th>Consultancy Fees</th>
    </tr>
    @foreach($doctors as $doctor)
    <tr>
      <td>{{ $doctor->did }}</td>
      <td>{{ $doctor->docname }}</td>
      <td>{{ $doctor->email }}</td>
      <td>{{ $doctor->contact }}</td>
      <td>{{ $doctor->spec }}</td>
      <td>{{ $doctor->docFees }}</td>
    </tr>
    @endforeach
  </table>
</body>

</html>