<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accepted_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('pro_id');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('job_price');
            $table->unsignedBigInteger('job_hours');
            $table->string('pro_email');
            $table->string('client_email');
            $table->unsignedBigInteger('hire_status');     
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
        Schema::dropIfExists('accepted_jobs');
    }
}
