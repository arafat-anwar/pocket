<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeAssets extends Migration
{
    public function up()
    {
        Schema::dropIfExists('employee_assets');
        
        Schema::create('employee_assets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('employee_id', false);
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

            $table->text('asset_code')->nullable();
            $table->text('asset_name')->nullable();
            $table->date('from');
            $table->text('description')->nullable();
            $table->text('image')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_assets');
    }
}
