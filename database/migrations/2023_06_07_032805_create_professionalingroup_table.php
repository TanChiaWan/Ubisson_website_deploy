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
        Schema::create('professional_in_groups', function (Blueprint $table) {
           
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('group_id');
                $table->timestamps();
    
                $table->index('user_id');
                $table->index('group_id');
    
                
                $table->foreign('user_id')->references('professional_id')->on('professionals')->onDelete('cascade');
                $table->foreign('group_id')->references('practice_group_id')->on('practice_groups')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionalingroup');
    }
};
