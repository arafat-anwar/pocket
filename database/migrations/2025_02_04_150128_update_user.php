<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->dropForeign([
                'employee_id',
            ]);

            $table->dropColumn([
                'employee_id',
            ]);

            $table->string('name')->after('id')->nullable();
            $table->string('email')->after('name')->unique()->nullable();
            $table->integer('gender')->after('email')->default(1);
            $table->text('image')->after('is_developer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
           $table->unsignedBigInteger('employee_id')->after('id');
           $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

           $table->dropColumn([
            'name',
            'email',
            'gender',
            'image'
           ]);
        });
    }
}
