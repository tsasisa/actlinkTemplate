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
        Schema::table('event', function (Blueprint $table) {
            $table->enum('eventType', ['Environment', 'Healthcare', 'Education', 'Social'])->after('eventPoints');
        });
    }

    public function down()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropColumn('eventType');
        });
    }
};
