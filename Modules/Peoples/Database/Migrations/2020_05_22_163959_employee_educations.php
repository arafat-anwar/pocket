<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeEducations extends Migration
{
    public function up()
    {
        Schema::dropIfExists('employee_education');
        
        Schema::create('employee_education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned();
            $table->string('title');
            $table->string('group')->nullable();
            $table->string('institute')->nullable();
            $table->string('result')->nullable();
            $table->string('cgpa')->nullable();
            $table->string('scale')->nullable();
            $table->string('year_of_passing')->nullable();
            $table->string('duration')->nullable();
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
        Schema::dropIfExists('employee_education');
    }
}
