<?php

namespace Database\Seeders;

use App\Models\Patreg;
use Illuminate\Database\Seeder;

class PatregSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Patreg::create([
      'session_id' => 'XYZ456',
      'username' => 'hardik',
      'email' => 'hardik@example.com',
      'contact' => '9876543211',
      'password' => bcrypt('hardik123')
    ]);
  }
}
