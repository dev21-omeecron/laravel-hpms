<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('admin', function (Blueprint $table) {
      $table->id('aid');
      $table->string('session_id', 100)->nullable();
      $table->string('username', 50);
      $table->string('email', 50)->unique();
      $table->string('password', 150);
      $table->string('contact', 12);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('admin');
  }
}
