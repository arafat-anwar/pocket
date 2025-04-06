<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompany extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('po_box')->after('agent_routing_code');
            $table->string('state')->after('po_box');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->string('nationality')->after('name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'po_box',
                'state',
            ]);
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn([
                'nationality',
            ]);
        });
    }
}
