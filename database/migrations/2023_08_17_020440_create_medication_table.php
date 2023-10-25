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
        Schema::create('medication', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('generic_name');
            $table->string('atc_classification');
            $table->string('formulation');
            $table->string('class')->nullable();   // Make the 'class' column nullable
            $table->string('company')->nullable(); // Make the 'company' column nullable
            $table->string('dosage')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication');
    }
};
