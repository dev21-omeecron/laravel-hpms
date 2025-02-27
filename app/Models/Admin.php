<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
  use HasFactory;

  protected $table = 'admin';
  protected $primaryKey = 'aid';

  protected $fillable = ['session_id', 'username', 'email', 'password', 'contact'];

  protected $hidden = ['password', 'session_id'];

  public function getAuthPassword()
  {
    return $this->password;
  }
}
