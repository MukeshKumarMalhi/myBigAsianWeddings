<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listing_attributes', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('business_listing_id')->nullable();
          $table->foreign('business_listing_id')->references('id')->on('business_listings')->onDelete('cascade')->onUpdate('cascade');
          $table->string('data_question_id')->nullable();
          $table->foreign('data_question_id')->references('id')->on('data_questions')->onDelete('cascade')->onUpdate('cascade');
          $table->string('data_answer_id')->nullable();
          $table->foreign('data_answer_id')->references('id')->on('data_answers')->onDelete('cascade')->onUpdate('cascade');
          $table->string('data_answer_text')->nullable();
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
        Schema::dropIfExists('business_listing_attributes');
    }
}
