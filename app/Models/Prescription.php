<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;





class Prescription extends Model
{
  use HasFactory;

  protected $table = 'prestb';

  protected $fillable = [
    'docname',
    'did',
    'pid',
    'aptid',
    'patname',
    'appdate',
    'apptime',
    'disease',
    'allergies',
    'prescription',
    'is_paid',
    'payment_method',
    'payment_details',
  ];


  public function appointment()
  {
    return $this->belongsTo(Appointment::class, 'aptid', 'aptid');
  }
}
