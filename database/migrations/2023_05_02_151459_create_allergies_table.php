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
        Schema::create('allergies', function (Blueprint $table) {
            $table->id('allergy_id')->unique();
            $table->unsignedBigInteger('patient_id_FK')->nullable();
            $table->foreign('patient_id_FK')->references('patient_id')->on('patients')->onDelete('cascade');;
            $table->string('allergy_name');
            $table->string('allergy_symptoms');
            $table->string('allergy_severity');
            $table->date('allergycreated_date')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergies');
    }
};
