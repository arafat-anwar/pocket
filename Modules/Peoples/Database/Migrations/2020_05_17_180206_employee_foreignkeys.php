<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeForeignkeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function($table) {
           $table->foreign('designation_id')->references('id')->on('designations')->onDelete('restrict')->onUpdate('cascade');
           $table->foreign('function_id')->references('id')->on('functions')->onDelete('restrict')->onUpdate('cascade');
           $table->foreign('sub_function_id')->references('id')->on('sub_functions')->onDelete('restrict')->onUpdate('cascade');
           $table->foreign('team_id')->references('id')->on('teams')->onDelete('restrict')->onUpdate('cascade');
           $table->foreign('catgory_id')->references('id')->on('employee_categories')->onDelete('restrict')->onUpdate('cascade');
           $table->foreign('job_level_id')->references('id')->on('job_levels')->onDelete('restrict')->onUpdate('cascade');
           $table->foreign('job_location_id')->references('id')->on('job_locations')->onDelete('restrict')->onUpdate('cascade');
           $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict')->onUpdate('cascade');
           $table->foreign('legal_entity_id')->references('id')->on('legal_entities')->onDelete('restrict')->onUpdate('cascade');
           $table->foreign('religion_id')->references('id')->on('religions')->onDelete('restrict')->onUpdate('cascade');
           $table->foreign('country_id')->references('id')->on('countries')->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('employee_details', function($table) {
           $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('employee_logs', function($table) {
           $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
