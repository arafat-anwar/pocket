<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class SalaryHead extends Model
{
    protected $fillable = [
    	'name',
        'basic',
        'type',
        'desc',
        'status',
    ];

    function details()
    {
        return $this->hasMany(SalaryHeadDetail::class);
    }
}
