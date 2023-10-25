<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practice_groups', function (Blueprint $table) {
            $table->id('practice_group_id');
            $table->unsignedBigInteger('organizationid_FK')->nullable();
            $table->foreign('organizationid_FK')->references('organizationid')->on('organizations')->onDelete('cascade');
            $table->string('name');
            $table->string('subTitle')->nullable();
            $table->integer('dangerHightotal')->default(0);
            $table->integer('dangerLowtotal')->default(0);
            $table->char('thread_id', 36)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practicegroup');
    }
};
