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
        Schema::create('patient_in_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();
            
            // Add foreign key constraints
           
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
            $table->foreign('group_id')->references('practice_group_id')->on('practice_groups')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('patient_in_groups');
    }
};
