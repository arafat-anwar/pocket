<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReportCredentials extends Migration
{
    public function up()
    {
        Schema::table('system_information', function (Blueprint $table) {
            $table->text('test_report_header_title')->nullable()->after('icon');
            $table->text('test_report_header_left_logo')->nullable()->after('test_report_header_title');
            $table->text('test_report_header_right_logo')->nullable()->after('test_report_header_left_logo');
            $table->longText('test_report_remarks')->nullable()->after('test_report_header_right_logo');
            $table->longText('test_report_notes')->nullable()->after('test_report_remarks');
            $table->longText('test_report_approver')->nullable()->after('test_report_notes');
            $table->longText('test_report_footer')->nullable()->after('test_report_approver');
        });
    }

    public function down()
    {
        Schema::table('system_information', function (Blueprint $table) {
            $table->dropColumn([
                'test_report_header_title',
                'test_report_header_left_logo',
                'test_report_header_right_logo',
                'test_report_remarks',
                'test_report_notes',
                'test_report_approver',
                'test_report_footer',
            ]);
        });
    }
}
