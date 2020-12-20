<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('pro_type');
            $table->string('looking_to_shoot');
            $table->string('event_address')->nullable();
            $table->string('street_number')->nullable();
            $table->string('route')->nullable();
            $table->string('locality')->nullable();
            $table->string('area')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('address_details')->nullable();
            $table->string('duration_')->nullable();
            $table->string('hours_')->nullable();
            $table->date('event_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('done_hiring')->default('0');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_bookings');
    }
}
