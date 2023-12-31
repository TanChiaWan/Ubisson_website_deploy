<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('medication_in_diagnosis', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('medication_id');
            $table->unsignedBigInteger('diagnosis_id');
            $table->string('taken_time');
            $table->json('taken'); // or use text('taken') if you want to store it as serialized text
            $table->string('medicationtype');
            $table->string('dosage');
            $table->string('timesaday');
            $table->timestamps();
            
            // Add foreign key constraints
           
            $table->foreign('medication_id')->references('id')->on('medication')->onDelete('cascade');
            $table->foreign('diagnosis_id')->references('diagnosis_id')->on('diagnoses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('patient_in_groups');
    }
};
