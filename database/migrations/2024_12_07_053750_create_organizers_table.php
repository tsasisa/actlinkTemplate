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
        Schema::create('organizers', function (Blueprint $table) {
            $table->integer('organizerId')->unsigned()->primary();
            $table->string('organizerAddress', 255)->nullable();
            $table->boolean('activeFlag')->default(false);
            $table->foreign('organizerId')->references('userId')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizers');
    }
};
