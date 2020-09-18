<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('location_id')->nullable();
          $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade')->onUpdate('cascade');
          $table->unsignedBigInteger('role_id')->default(2);
          $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
          $table->string('name');
          $table->string('provider')->nullable();
          $table->string('provider_id')->nullable();
          $table->enum('account_type', ['bride', 'groom'])->nullable();
          $table->string('partner_name')->nullable();
          $table->string('email')->unique();
          $table->string('partner_email')->nullable();
          $table->string('user_image')->nullable();
          $table->string('user_url')->nullable();
          $table->text('planning_done')->nullable();
          $table->string('weeding_location')->nullable();
          $table->integer('weeding_budget')->default(0);
          $table->integer('weeding_no_guests')->default(0);
          $table->datetime('weeding_date')->nullable();
          $table->enum('status', ['activated', 'deactivated'])->default('activated');
          $table->timestamp('email_verified_at')->nullable();
          $table->string('password');
          $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
