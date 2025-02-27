<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('appointments', function (Blueprint $table) {
      $table->charset = 'latin1';
      $table->collation = 'latin1_swedish_ci';

      $table->integer('pid');
      $table->integer('did');
      $table->string('aptid', 255);
      $table->string('patname', 50);
      $table->string('email', 30);
      $table->string('contact', 10);
      $table->string('docname', 50);
      $table->string('docFees', 10);
      $table->string('spec', 30);
      $table->date('appdate');
      $table->time('apptime');
      $table->integer('userStatus');
      $table->integer('doctorStatus');
      $table->timestamps();

      $table->primary('aptid');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('appointments');
  }
}
