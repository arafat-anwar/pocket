<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AttendanceSeetings extends Migration
{
    public function up()
    {
        Schema::dropIfExists('attendance_settings');
        
        Schema::create('attendance_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->integer('in_time_tolerance')->default(15);
            $table->integer('out_time_tolerance')->default(15);
            $table->time('night_shift_starts_from')->default('20:00:00');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendance_settings');
    }
}
