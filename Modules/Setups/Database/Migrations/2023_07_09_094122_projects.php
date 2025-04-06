<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{
    public function up()
    {
        Schema::dropIfExists('projects');
        
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('restrict')->onUpdate('cascade');

            $table->text('code');
            $table->text('name');
            $table->date('from');
            $table->date('to');
            $table->text('objectives')->nullable();
            $table->text('budget')->nullable();
            $table->text('deliverables')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
