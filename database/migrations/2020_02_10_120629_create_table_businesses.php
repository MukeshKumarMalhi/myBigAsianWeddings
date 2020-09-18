<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBusinesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('category_id')->nullable();
          $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
          $table->string('location_id')->nullable();
          $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade')->onUpdate('cascade');
          $table->string('name')->nullable();
          $table->string('tagline')->nullable();
          $table->text('description')->nullable();
          $table->string('email')->nullable();
          $table->string('mobile')->nullable();
          $table->string('phone')->nullable();
          $table->string('whatsapp')->nullable();
          $table->binary('website_url')->nullable();
          $table->binary('facebook_url')->nullable();
          $table->binary('instagram_url')->nullable();
          $table->binary('linkedIn_url')->nullable();
          $table->binary('twitter_url')->nullable();
          $table->binary('youtube_channel_url')->nullable();
          $table->string('google_plus')->nullable();
          $table->text('address')->nullable();
          $table->string('geo_latitude')->nullable();
          $table->string('geo_longitude')->nullable();
          $table->string('map_pin')->nullable();
          $table->binary('business_logo')->nullable();
          $table->enum('business_status', ['activated', 'deactivated'])->default('activated');
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
        Schema::dropIfExists('businesses');
    }
}
