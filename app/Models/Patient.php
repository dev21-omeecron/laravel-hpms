<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{
  use HasFactory, Notifiable;

  protected $table = 'patreg';
  protected $primaryKey = 'pid';

  protected $fillable = ['session_id', 'username', 'email', 'password', 'contact'];

  protected $hidden = ['password', 'session_id'];

  public function getAuthPassword()
  {
    return $this->password;
  }
}
