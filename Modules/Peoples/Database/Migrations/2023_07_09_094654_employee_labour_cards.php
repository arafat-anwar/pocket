<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeLabourCards extends Migration
{
    public function up()
    {
        Schema::dropIfExists('employee_labour_cards');
        
        Schema::create('employee_labour_cards', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('employee_id', false);
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

            $table->text('labour_card_no')->nullable();
            $table->date('using_from');
            $table->date('expiry_date');
            $table->text('description')->nullable();
            $table->text('image')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_labour_cards');
    }
}
