<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listings', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('category_id')->nullable();
          $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
          $table->string('name')->nullable();
          $table->string('email')->nullable();
          $table->string('password')->nullable();
          $table->boolean('status')->default(true);
          $table->timestamp('last_login')->nullable();
          $table->string('login_ip')->nullable();
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
        Schema::dropIfExists('business_listings');
    }
}
