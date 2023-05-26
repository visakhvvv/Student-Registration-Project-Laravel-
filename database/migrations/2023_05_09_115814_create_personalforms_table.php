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
        Schema::create('personalforms', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phonenumber');
            $table->string('emailaddress');
            $table->string('country');
            $table->string('language');
            $table->string('username');
            $table->string('emailaddress1');
            $table->string('password');
            $table->string('confirmpassword');
            $table->string('schoolname');
            $table->string('boardname');
            $table->string('coursename');
            $table->string('universityname');
            $table->string('experience1');
            $table->string('position1');
            $table->string('experience2');
            $table->string('position2');
            $table->string('experience3');
            $table->string('position3');
            $table->string('fileup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personalforms');
    }
};
