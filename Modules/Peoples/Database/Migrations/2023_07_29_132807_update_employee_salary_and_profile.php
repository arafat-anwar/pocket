<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmployeeSalaryAndProfile extends Migration
{
    public function up()
    {
        Schema::table('employee_salaries', function($table) {
           $table->double('overtime_per_hour_amount')->after('overtime_per_hour_percentage')->default(0);
           $table->double('holiday_per_hour_amount')->after('holiday_per_hour_percentage')->default(0);
        });

        Schema::table('employees', function($table) {
           $table->integer('is_fixed')->after('authorized_person_id')->default(0);
        });
    }

    public function down()
    {
        Schema::table('employee_salaries', function($table) {
           $table->dropColumn([
            'overtime_per_hour_amount',
            'holiday_per_hour_amount',
           ]);
        });

        Schema::table('employees', function($table) {
           $table->dropColumn([
            'is_fixed'
           ]);
        });
    }
}
