<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeLogs extends Migration
{
    public function up()
    {
        Schema::dropIfExists('employee_logs');
        
        Schema::create('employee_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned();
            $table->bigInteger('module_id')->unsigned()->nullable();
            $table->bigInteger('menu_id')->unsigned()->nullable();
            $table->bigInteger('submenu_id')->unsigned()->nullable();
            $table->text('logs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_logs');
    }
}
