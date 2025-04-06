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
            $table->string('uid');
            $table->string('card_no')->nullable();
            $table->string('machine_id')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('gender')->default(1);
            $table->bigInteger('designation_id')->unsigned();
            $table->bigInteger('function_id')->unsigned();
            $table->bigInteger('sub_function_id')->unsigned();
            $table->bigInteger('team_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('job_level_id')->unsigned();
            $table->bigInteger('job_location_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('legal_entity_id')->unsigned();
            $table->bigInteger('religion_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('reporting_manager_id');
            $table->bigInteger('authorized_person_id');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('employees');
    }
}
