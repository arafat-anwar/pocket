<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntryTypes extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::dropIfExists('entry_types');
        // Schema::create('entry_types', function (Blueprint $table) {
        //     $table->id();

        //     $table->string('name');
        //     $table->string('sign');
        //     $table->string('color');
        //     $table->integer('positive')->default(1);
        //     $table->text('desc')->nullable();
        //     $table->integer('status')->default(1);

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('entry_types');
    }
}
