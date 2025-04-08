<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Entries extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::dropIfExists('entries');
        // Schema::create('entries', function (Blueprint $table) {
        //     $table->id();

        //     $table->unsignedBigInteger('user_id', false);
        //     $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

        //     $table->unsignedBigInteger('entry_type_id', false);
        //     $table->foreign('entry_type_id')->references('id')->on('entry_types')->cascadeOnDelete()->cascadeOnUpdate();

        //     $table->string('title');
        //     $table->double('amount');
        //     $table->date('date');
        //     $table->integer('status')->default(1);

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('entries');
    }
}
