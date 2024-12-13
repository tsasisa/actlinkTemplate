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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('userId');
            $table->string('userName', 255);
            $table->string('userEmail', 255);
            $table->string('userPassword', 255);
            $table->string('userPhoneNumber', 255)->nullable();
            $table->text('userImage')->nullable(); // Store Base64-encoded image
            $table->string('userType', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
