<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listing_details', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('business_listing_id')->nullable();
          $table->foreign('business_listing_id')->references('id')->on('business_listings')->onDelete('cascade')->onUpdate('cascade');
          $table->string('created_user_id')->nullable();
          $table->foreign('created_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $table->string('updated_user_id')->nullable();
          $table->foreign('updated_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $table->string('created_by_user')->nullable();
          $table->string('updated_by_user')->nullable();
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
        Schema::dropIfExists('business_listing_details');
    }
}
