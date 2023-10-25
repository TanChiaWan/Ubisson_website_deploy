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
        Schema::create('healthdatas', function (Blueprint $table) {
            $table->id('healthdata_id');
            
            $table->unsignedBigInteger('patient_id_FK')->nullable();
            $table->foreign('patient_id_FK')->references('patient_id')->on('patients')->onDelete('cascade');;

            $table->date('date');
          $table->float('weight');
        $table->float('height');
        $table->integer('sbp');
        $table->integer('dbp');
        $table->integer('pulse');
        $table->float('hr')->nullable();;
        $table->float('celcius');
        $table->float('fahrenheit');
        $table->float('a1cpercentage')->nullable();
        $table->float('lotview')->nullable();
        $table->float('testID')->nullable();
        $table->float('operator')->nullable();
        $table->float('instid')->nullable();
        $table->float('ga');
        $table->float('cho');
        $table->float('hdl');
        $table->float('ldlc');
        $table->float('tg');
        $table->float('tc')->nullable();;
        $table->float('cpeptide');
        $table->float('ckdstage');
        $table->float('cre');
        $table->float('ua');
        $table->float('egfr');
        $table->float('acr');
        $table->float('ma');
        $table->float('pro');
        $table->float('upcr');
        $table->float('ca');
        $table->float('k');
        $table->float('na');
        $table->float('p');
        $table->float('gpt/alt');
        $table->float('got');
        $table->float('carbon')->nullable();;
        $table->float('activity')->nullable();;

        $table->string('unit')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healthdatas');
    }
};
