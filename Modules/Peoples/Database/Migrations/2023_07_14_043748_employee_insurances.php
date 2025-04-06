<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeInsurances extends Migration
{
    public function up()
    {
        Schema::dropIfExists('employee_insurances');
        
        Schema::create('employee_insurances', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('employee_id', false);
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

            $table->text('insurance_no')->nullable();
            $table->date('from');
            $table->date('to');
            $table->double('installment');
            $table->double('amount');
            $table->text('description')->nullable();
            $table->text('image')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_insurances');
    }
}
