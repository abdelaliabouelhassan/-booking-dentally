<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booked_api_records', function (Blueprint $table) {
            $table->id();
            $table->integer('treatment_id')->unsigned();
            $table->string('treatment_name');
            $table->integer('practitioner_id')->unsigned();
            $table->string('practitioner_name');
            $table->string('site_id');
            $table->text('practitioner_image');
            $table->dateTime('appointment_start_date');
            $table->dateTime('appointment_end_date');
            $table->string('appointment_duration');
            $table->integer('patient_id');
            $table->string('patient_title');
            $table->string('patient_first_name');
            $table->string('patient_last_name');
            $table->string('patient_email');
            $table->string('patient_phone');
            $table->string('patient_address');
            $table->string('patient_postcode');
            $table->string('patient_birthday');
            $table->text('patient_image');
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
        Schema::dropIfExists('booked_api_records');
    }
};
