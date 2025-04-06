<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeChilds extends Migration
{
    public function up()
    {
        Schema::dropIfExists('employee_children');
        
        Schema::create('employee_children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned();
            $table->string('name')->nullable();
            $table->integer('gender')->default(1);
            $table->date('date_of_birth')->nullable();
            $table->integer('blood_group')->default(0);
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
        Schema::dropIfExists('employee_children');
    }
}
