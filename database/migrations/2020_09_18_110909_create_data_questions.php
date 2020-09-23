<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_questions', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('data_type_id')->nullable();
          $table->foreign('data_type_id')->references('id')->on('data_types')->onDelete('cascade')->onUpdate('cascade');
          $table->string('data_section_id')->nullable();
          $table->foreign('data_section_id')->references('id')->on('data_sections')->onDelete('cascade')->onUpdate('cascade');
          $table->string('question_name')->nullable();
          $table->boolean('question_status')->nullable();
          $table->integer('question_order')->nullable();
          $table->boolean('question_basic_search')->nullable();
          $table->boolean('question_advance_search')->nullable();
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
        Schema::dropIfExists('data_questions');
    }
}
