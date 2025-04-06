<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BasicInformation extends Migration
{
    public function up()
    {
        Schema::table('system_information', function (Blueprint $table) {
            $table->text('whatsapp_1')->nullable()->after('test_report_footer');
            $table->text('whatsapp_2')->nullable()->after('whatsapp_1');
            $table->text('about_the_company')->nullable()->after('whatsapp_2');
            $table->text('banner')->nullable()->after('about_the_company');
            $table->text('map')->nullable()->after('banner');
        });
    }

    public function down()
    {
        Schema::table('system_information', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_1',
                'whatsapp_2',
                'about_the_company',
                'map',
            ]);
        });
    }
}
