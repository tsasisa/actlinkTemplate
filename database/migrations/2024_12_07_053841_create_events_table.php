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
        Schema::create('event', function (Blueprint $table) {
            $table->increments('eventId');
            $table->string('eventName', 255);
            $table->string('eventDescription', 255)->nullable();
            $table->text('eventImage')->nullable(); // Store Base64-encoded image
            $table->date('eventDate')->nullable();
            $table->string('eventLocation', 255)->nullable();
            $table->integer('isHeld')->default(0);
            $table->integer('eventParticipantQuota')->nullable();
            $table->integer('eventParticipantNumber')->default(0);
            $table->integer('eventPoints')->default(0);
            $table->string('eventUpdates', 255)->nullable();
            $table->integer('organizerId')->unsigned()->nullable();

            $table->foreign('organizerId')->references('organizerId')->on('organizer')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('event');
    }
};
