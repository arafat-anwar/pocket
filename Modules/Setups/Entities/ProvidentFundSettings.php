<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class ProvidentFundSettings extends Model
{
    protected $fillable = [
    	'date',
        'company_percentage',
        'employee_percentage',
        'desc',
        'employee_id',
        'status',
    ];

    function employee()
    {
    	return $this->belongsTo(\Modules\Peoples\Entities\Employee::class);
    }
}
