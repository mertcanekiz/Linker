<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('visits', function (Blueprint $table) {
      $table->id();
      $table->foreignId('link_id');
      $table->string('user_agent');
      $table->timestamps();

      $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('visits');
  }
}
