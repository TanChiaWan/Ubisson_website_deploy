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
        Schema::create('remarks', function (Blueprint $table) {
            
            $table->id('remark_id');
            $table->unsignedBigInteger('patient_id_FK')->nullable();
            $table->foreign('patient_id_FK')->references('patient_id')->on('patients')->onDelete('cascade');;
            $table->unsignedBigInteger('professional_id')->nullable();
            $table->foreign('professional_id')->references('professional_id')->on('professionals')->onDelete('cascade');;
            $table->string('remark_image');
            $table->string('remark_file')->nullable();
            $table->text('remark_comment');
            $table->timestamp('remark_created_date'); // Use timestamp type instead of datetime
            $table->string('status');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remarks');
    }
};
