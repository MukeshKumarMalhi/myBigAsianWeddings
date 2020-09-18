<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sections', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('data_question_id')->nullable();
          $table->foreign('data_question_id')->references('id')->on('data_questions')->onDelete('cascade')->onUpdate('cascade');
          $table->string('section_name')->nullable();
          $table->boolean('section_status')->nullable();
          $table->integer('section_order')->nullable();
          $table->boolean('section_basic_search')->nullable();
          $table->boolean('section_advance_search')->nullable();
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
        Schema::dropIfExists('data_sections');
    }
}
