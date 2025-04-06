<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'code',
        'name',
        'phone',
        'mobile',
        'address',
        'email',
        'website',
        'labour_file_no',
        'sif_processing_fees',
        'service_charge',
        'vat',
        'mol_id',
        'agent_routing_code',
        'po_box',
        'state',
        'policy',
        'logo',
        'status',
    ];

    function projects(){
        return $this->hasMany(Project::class);
    }

    function employees(){
        return $this->hasMany(\Modules\Peoples\Entities\Employee::class);
    }
}
