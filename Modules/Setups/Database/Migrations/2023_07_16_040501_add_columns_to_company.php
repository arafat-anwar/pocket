<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCompany extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('labour_file_no')->after('website');
            $table->double('sif_processing_fees')->after('labour_file_no')->default(0);
            $table->double('service_charge')->after('sif_processing_fees')->default(0);
            $table->double('vat')->after('service_charge')->default(0);
            $table->string('mol_id')->after('vat')->nullable();
            $table->string('agent_routing_code')->after('mol_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'labour_file_no',
                'sif_processing_fees',
                'service_charge',
                'vat',
                'mol_id',
                'agent_routing_code',
            ]);
        });
    }
}
