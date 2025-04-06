<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReportLogoSwitch extends Migration
{
    public function up()
    {
        Schema::table('system_information', function (Blueprint $table) {
            $table->enum('show_logo_in_report', ['yes', 'no'])->default('yes')->after('logo');
        });
    }

    public function down()
    {
        Schema::table('system_information', function (Blueprint $table) {
            $table->dropColumn([
                'show_logo_in_report',
            ]);
        });
    }
}
