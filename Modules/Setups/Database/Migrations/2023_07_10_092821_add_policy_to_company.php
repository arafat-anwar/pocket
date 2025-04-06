<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPolicyToCompany extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->longText('policy')->after('website')->nullable();
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['policy']);
        });
    }
}
