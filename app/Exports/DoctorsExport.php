<?php

namespace App\Exports;

use App\Models\Doctor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DoctorsExport implements FromCollection, WithHeadings
{
  public function collection()
  {
    return Doctor::all();
  }

  public function headings(): array
  {
    return [
      'Doctor ID',
      'Doctor Name',
      'Doctor Email',
      'Contact',
      'Specialization',
      'Consultancy Fees'
    ];
  }
}
