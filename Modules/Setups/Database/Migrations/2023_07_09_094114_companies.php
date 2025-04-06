<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Companies extends Migration
{
    public function up()
    {
        Schema::dropIfExists('companies');
        
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('code');
            $table->text('name');
            $table->text('phone')->nullable();
            $table->text('mobile')->nullable();
            $table->text('address')->nullable();
            $table->text('email')->nullable();
            $table->text('website')->nullable();
            $table->text('logo')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
