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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('account_type');
            $table->string('pro_type')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('receive_text')->nullable();
            $table->string('moto')->nullable();
            $table->string('business_adress')->nullable();
            $table->string('street_number')->nullable();
            $table->string('route')->nullable();
            $table->string('locality')->nullable();
            $table->string('area')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
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
