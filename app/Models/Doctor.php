<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Authenticatable
{
  use HasFactory;

  protected $table = 'doctreg';
  protected $primaryKey = 'did';

  protected $fillable = [
    'session_id',
    'docname',
    'email',
    'password',
    'contact',
    'docFees',
    'spec'
  ];

  protected $hidden = ['password', 'session_id'];

  public function getAuthPassword()
  {
    return $this->password;
  }

  // public function setPasswordAttribute($value)
  // {
  //   $this->attributes['password'] = Hash::make($value);
  // }
}
