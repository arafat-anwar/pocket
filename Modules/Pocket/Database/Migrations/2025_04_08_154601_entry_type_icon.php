<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntryTypeIcon extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('entry_types', function (Blueprint $table) {
            $table->string('icon')->after('positive')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entry_types', function (Blueprint $table) {
            $table->dropColumn([
             'icon'
             ]);
        });
    }
}
