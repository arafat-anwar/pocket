<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeDetails extends Migration
{
    public function up()
    {
        Schema::dropIfExists('employee_details');
        
        Schema::create('employee_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned();
            $table->string('nid')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('official_date_of_birth')->nullable();
            $table->date('actual_date_of_birth')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('confirmation_date')->nullable();
            $table->string('blood_group')->nullable();
            $table->integer('vehicle')->default(0);
            $table->integer('ot')->default(0);
            $table->integer('pf')->default(0);
            $table->text('weekends')->nullable();
            $table->text('father')->nullable();
            $table->text('mother')->nullable();
            $table->integer('marital_status')->default(0);
            $table->date('marriage_date')->nullable();
            $table->text('spouse_name')->nullable();
            $table->text('spouse_date_of_birth')->nullable();
            $table->text('emg_contact_no')->nullable();
            $table->text('emg_contact_person')->nullable();
            $table->text('emg_contact_person_relation')->nullable();
            $table->text('health_issues')->nullable();
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('employee_details');
    }
        
}
