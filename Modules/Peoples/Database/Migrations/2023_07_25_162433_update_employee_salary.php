<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmployeeSalary extends Migration
{
    public function up()
    {
        Schema::table('employee_salaries', function($table) {
           $table->double('per_hour_deduction_rate')->after('per_hour_rate')->default(0);
        });
    }

    public function down()
    {
        Schema::table('employee_salaries', function($table) {
           $table->dropColumn([
            'per_hour_deduction_rate',
           ]);
        });
    }
}
