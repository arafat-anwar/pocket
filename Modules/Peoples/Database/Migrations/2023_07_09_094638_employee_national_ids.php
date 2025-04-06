<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeNationalIds extends Migration
{
    public function up()
    {
        Schema::dropIfExists('employee_national_ids');
        
        Schema::create('employee_national_ids', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('employee_id', false);
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

            $table->text('nid_no')->nullable();
            $table->date('using_from');
            $table->date('expiry_date');
            $table->text('description')->nullable();
            $table->text('image')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_national_ids');
    }
}
