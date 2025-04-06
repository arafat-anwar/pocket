<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmployeeInsurance extends Migration
{
    public function up()
    {
        Schema::table('employee_insurances', function (Blueprint $table) {
            $table->dropColumn([
                'installment'
            ]);
            $table->text('insurer')->after('amount');
        });
    }

    public function down()
    {
        Schema::table('employee_insurances', function (Blueprint $table) {
            $table->dropColumn([
                'insurer'
            ]);
            $table->double('installment')->after('to');
        });
    }
}
