<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestbTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('prestb', function (Blueprint $table) {
      $table->charset = 'latin1';
      $table->collation = 'latin1_swedish_ci';

      $table->string('docname', 50);
      $table->integer('did');
      $table->integer('pid');
      $table->bigInteger('aptid');
      $table->string('patname', 50);
      $table->date('appdate');
      $table->time('apptime');
      $table->string('disease', 100);
      $table->string('allergies', 100);
      $table->string('prescription', 255);
      $table->integer('is_paid')->default(0)->nullable();
      $table->string('payment_method', 25)->nullable();
      $table->string('payment_details', 255)->nullable();
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
    Schema::dropIfExists('prestb');
  }
}
