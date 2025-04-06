<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeSalaryHeads extends Migration
{
    public function up()
    {
        Schema::dropIfExists('employee_salary_heads');
        
        Schema::create('employee_salary_heads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_salary_id')->unsigned();
            $table->bigInteger('salary_head_id')->unsigned();
            $table->bigInteger('amount')->unsigned();
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
        Schema::dropIfExists('employee_salary_heads');
    }
}
