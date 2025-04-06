<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCards extends Migration
{
    public function up()
    {
        Schema::table('employee_national_ids', function($table) {
           $table->text('image_back')->after('image')->nullable();
        });

        Schema::table('employee_passports', function($table) {
           $table->text('image_back')->after('image')->nullable();
        });

        Schema::table('employee_labour_cards', function($table) {
           $table->text('image_back')->after('image')->nullable();
        });
    }

    public function down()
    {
        Schema::table('employee_national_ids', function($table) {
           $table->dropColumn([
            'image_back',
           ]);
        });

        Schema::table('employee_passports', function($table) {
           $table->dropColumn([
            'image_back',
           ]);
        });

        Schema::table('employee_labour_cards', function($table) {
           $table->dropColumn([
            'image_back',
           ]);
        });
    }
}
