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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id('logbook_id')->unique();
            $table->unsignedBigInteger('patient_id_FK')->nullable();
            $table->foreign('patient_id_FK')->references('patient_id')->on('patients')->onDelete('cascade');;
            $table->date('bp_logbook_date');
            $table->float('bp_level');
            $table->float('bp_level2');
            $table->string('bp_period');
            $table->string('bp_pulse');
            $table->timestamp('bg_logbook_date');
            $table->float('bg_level');
            $table->float('carbohydrate')->nullable();;
            $table->float('rapid')->nullable();;
            $table->float('exercise')->nullable();;
            $table->string('image_title')->nullable();;
            $table->string('image')->nullable();;
            $table->string('bg_period');
            $table->json('bp_read')->nullable();
            $table->json('bg_read')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
