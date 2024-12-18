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
        Schema::create('claimed_items', function (Blueprint $table) {
            $table->increments('claimId');
            $table->integer('userId')->unsigned();
            $table->integer('itemId')->unsigned();
            $table->timestamps();
        
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');
            $table->foreign('itemId')->references('itemId')->on('shop_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claimed_items');
    }
};
