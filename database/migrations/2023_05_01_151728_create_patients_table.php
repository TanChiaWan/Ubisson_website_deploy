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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('patient_id')->unique();
            $table->unsignedBigInteger('organizationid_FK')->nullable();
            $table->foreign('organizationid_FK')->references('organizationid')->on('organizations')->onDelete('cascade');
            $table->string('organization_name')->nullable();
            $table->integer('patient_number');
            $table->string('patient_image');
            $table->string('patient_name');
            $table->string('patient_gender');
            $table->integer('patient_age');
            $table->string('diabetes_type');
            $table->date('date_of_birth');
            $table->date('date_of_diagnosis');
            $table->decimal('idealrangeBG_low')->default(80); // Lower limit of the ideal blood glucose range (defaulted to 80 mg/dL)
            $table->decimal('idealrangeBG_high')->default(130); // Upper limit of the ideal blood glucose range (defaulted to 130 mg/dL)
            $table->integer('triggertimes')->default(0);
            $table->integer('dangerHigh')->default(0);
            $table->integer('dangerLow')->default(0);
            $table->decimal('dangerousrangeBG_low')->default(30); // Represents the starting value of the lower limit of the dangerous blood glucose range
            $table->decimal('dangerousrangeBG_high')->default(200); // Represents the ending value of the upper limit of the dangerous blood glucose range
            $table->integer('patient_phonenum');
            $table->string('emergencypersonname');
            $table->string('emergencypersonphonenum');

            $table->decimal('targetBG_low_BC')->default(4); // Lower limit of the ideal blood glucose range (defaulted to 80 mg/dL)
            $table->decimal('targetBG_high_BC')->default(10); // Upper limit of the ideal blood glucose range (defaulted to 130 mg/dL)
            $table->decimal('targetBG_low_AC')->default(4); // Lower limit of the ideal blood glucose range (defaulted to 80 mg/dL)
            $table->decimal('targetBG_high_AC')->default(10); // Upper limit of the ideal blood glucose range (defaulted to 130 mg/dL)
            $table->decimal('targetBG_low_BT')->default(4);
            $table->decimal('targetBG_high_BT')->default(10);
            $table->decimal('targethba1c')->default(5);
            $table->decimal('mincarb')->default(5);
            $table->decimal('maxcarb')->default(5);
            $table->decimal('minweight')->default(5);
            $table->decimal('maxweight')->default(5);
            $table->decimal('minbmi')->default(17.9);
            $table->decimal('maxbmi')->default(25.0);
            $table->decimal('totalactivity')->default(5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
