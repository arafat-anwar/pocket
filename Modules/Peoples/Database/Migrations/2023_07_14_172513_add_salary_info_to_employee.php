<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalaryInfoToEmployee extends Migration
{
    public function up()
    {
        Schema::table('employee_salaries', function($table) {
           $table->string('bank_iban_number')->after('bank_account');
           $table->double('per_hour_rate')->default(0)->after('gross_amount');
           $table->double('overtime_per_hour_percentage')->default(125)->after('per_hour_rate');
           $table->double('holiday_per_hour_percentage')->default(150)->after('overtime_per_hour_percentage');
           $table->double('bank_payment_amount')->default(50)->after('holiday_per_hour_percentage');
           $table->double('cash_payment_amount')->default(50)->after('bank_payment_amount');
        });
    }

    public function down()
    {
        Schema::table('employee_salaries', function($table) {
           $table->dropColumn([
            'bank_iban_number',
            'per_hour_rate',
            'overtime_per_hour_percentage',
            'holiday_per_hour_percentage',
            'bank_payment_amount',
            'cash_payment_amount',
           ]);
        });
    }
}
