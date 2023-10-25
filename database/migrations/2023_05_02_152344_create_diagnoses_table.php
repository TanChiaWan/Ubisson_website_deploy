<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id('diagnosis_id')->unique();
            $table->unsignedBigInteger('patient_id_FK')->nullable();
            $table->foreign('patient_id_FK')->references('patient_id')->on('patients')->onDelete('cascade');;
            $table->unsignedBigInteger('professional_id')->nullable();
            $table->foreign('professional_id')->references('professional_id')->on('professionals')->onDelete('cascade');;
            $table->string('diagnosis_title');
            $table->date('diagnosis_startdate');
            $table->date('diagnosis_enddate');
            $table->string('severity');
            $table->date('diagnosiscreated_date');
            $table->date('diagnosisupdated_date');
            $table->json('medicines')->nullable(); // Store an array of medicine IDs
            $table->boolean('inuse')->default(0);
            $table->string('taken_period');
            $table->string('date_taken')->nullable()->default('-'); // Changed to string data type
            $table->boolean('active')->default(0);
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
        
    }
};
