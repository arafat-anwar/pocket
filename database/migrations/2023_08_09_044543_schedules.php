<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Schedules extends Migration
{
    public function up()
    {
        Schema::create('crons', function (Blueprint $table) {
            $table->id();
            $table->text('process')->nullable();
            $table->text('output')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crons');
    }
}
