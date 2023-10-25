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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id('organizationid')->unique();
            $table->string('organization_name');
            $table->string('customized_login_url')->default('');
            $table->string('address');
            $table->string('organization_mobile_phone', 20);
            $table->string('administrator_name')->nullable();
            $table->string('administrator_username')->nullable();
            $table->string('administrator_email_address')->nullable();
            $table->string('prefer_language');
            $table->string('region');
            $table->string('blood_glucose_unit');
            $table->string('other_unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
