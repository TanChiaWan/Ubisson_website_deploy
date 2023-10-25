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
    Schema::create('professionals', function (Blueprint $table) {
        $table->id('professional_id')->unique();
        $table->unsignedBigInteger('organizationid_FK')->nullable();
        $table->foreign('organizationid_FK')->references('organizationid')->on('organizations')->onDelete('cascade');
        $table->string('organization_name')->nullable();
        $table->string('professional_image')->nullable();;
        $table->string('professional_name');
        $table->string('professional_gender');
        $table->string('professional_mobile_phone');
  
        $table->string('username');
        $table->string('password');
        $table->string('plain_password')->nullable();
        $table->string('professional_email_address');
        $table->string('professional_type_of_profession');
        $table->string('professional_account_role');
        $table->string('temperature_unit')->default('Celcius (°C)');
        $table->unsignedBigInteger('role_id')->nullable(); // Add 'role_id' column
        $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        $table->enum('status', ['Active', 'Disabled'])->default('Active'); // Add 'status' column
        $table->rememberToken();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
