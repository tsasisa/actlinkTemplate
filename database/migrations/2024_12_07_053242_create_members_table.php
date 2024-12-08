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
        Schema::create('member', function (Blueprint $table) {
            $table->integer('memberId')->unsigned()->primary();
            $table->date('memberDOB')->nullable();
            $table->integer('memberPoints')->default(0);

            $table->foreign('memberId')->references('userId')->on('user')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('member');
    }
};
