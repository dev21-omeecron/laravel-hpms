<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctregTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('doctreg', function (Blueprint $table) {
      $table->id('did');
      $table->string('session_id', 255)->nullable();
      $table->string('docname', 50);
      $table->string('email', 50)->unique();
      $table->string('contact', 12);
      $table->string('password', 150);
      $table->string('spec', 30);
      $table->string('docFees', 10);
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
    Schema::dropIfExists('doctreg');
  }
}
