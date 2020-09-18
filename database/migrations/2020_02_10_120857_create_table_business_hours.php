<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBusinessHours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_hours', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('business_id')->nullable();
          $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade')->onUpdate('cascade');
          $table->text('business_hours_json')->nullable();
          $table->string('from_monday')->nullable();
          $table->string('to_monday')->nullable();
          $table->string('from_tuesday')->nullable();
          $table->string('to_tuesday')->nullable();
          $table->string('from_wednesday')->nullable();
          $table->string('to_wednesday')->nullable();
          $table->string('from_thursday')->nullable();
          $table->string('to_thursday')->nullable();
          $table->string('from_friday')->nullable();
          $table->string('to_friday')->nullable();
          $table->string('from_saturday')->nullable();
          $table->string('to_saturday')->nullable();
          $table->string('from_sunday')->nullable();
          $table->string('to_sunday')->nullable();
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
        Schema::dropIfExists('business_hours');
    }
}
