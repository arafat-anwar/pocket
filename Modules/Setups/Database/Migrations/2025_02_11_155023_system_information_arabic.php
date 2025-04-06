<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemInformationArabic extends Migration
{
    public function up()
    {
        Schema::table('system_information', function (Blueprint $table) {
            $table->longText('banner_text')->nullable()->after('whatsapp_2');
            $table->longText('about_the_company')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('system_information', function (Blueprint $table) {
            $table->text('about_the_company')->nullable()->change();

            $table->dropColumn([
                'banner_text',
            ]);
        });
    }
}
