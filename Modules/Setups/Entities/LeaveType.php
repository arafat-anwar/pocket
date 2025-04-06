<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = [
    	'name',
        'balance',
        'hour_leave',
        'half_day',
        'documents',
        'gender_oriented',
        'gender',
        'desc',
        'status',
    ];

    function leaves()
    {
        return $this->hasMany(\Modules\Leave\Entities\Leave::class);
    }
}
