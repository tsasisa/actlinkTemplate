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
        Schema::create('admin', function (Blueprint $table) {
            $table->integer('adminId')->unsigned()->primary();
            $table->foreign('adminId')->references('userId')->on('user')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin');
    }
};
