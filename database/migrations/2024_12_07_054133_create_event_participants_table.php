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
        Schema::create('eventParticipants', function (Blueprint $table) {
            $table->increments('eventParticipantId');
            $table->integer('memberId')->unsigned();
            $table->integer('eventId')->unsigned();
            $table->date('registeredDate')->nullable();

            $table->foreign('memberId')->references('memberId')->on('members')->onDelete('cascade');
            $table->foreign('eventId')->references('eventId')->on('events')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('eventParticipants');
    }
};
