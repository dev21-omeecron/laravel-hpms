<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
  use HasFactory;

  protected $table = 'appointments';

  protected $primaryKey = 'aptid';

  protected $fillable = [
    'pid',
    'did',
    'aptid',
    'patname',
    'email',
    'contact',
    'docname',
    'docFees',
    'spec',
    'appdate',
    'apptime',
    'userStatus',
    'doctorStatus'
  ];

  public function prescriptions()
  {
    return $this->hasMany(Prescription::class, 'aptid', 'aptid');
  }
}
