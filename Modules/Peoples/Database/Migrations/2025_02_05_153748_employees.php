<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Employees extends Migration
{
    public function up()
    {
        Schema::dropIfExists('employees');
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();

            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            
            $table->text('address')->nullable();

            $table->text('identity')->nullable();
            $table->text('identity_file')->nullable();

            $table->text('passport')->nullable();
            $table->text('passport_file')->nullable();
            
            $table->text('license')->nullable();
            $table->text('license_file')->nullable();

            $table->enum('type', ['driver', 'trip-staff', 'office-staff'])->default('driver');
            $table->text('description')->nullable();
            $table->text('image')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
