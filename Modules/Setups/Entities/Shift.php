<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
    	'type',
        'name',
        'from',
        'to',
        'desc',
        'status',
    ];

    function employees()
    {
    	return $this->hasMany(\Modules\Peoples\Entities\EmployeeShift::class);
    }

    function attendances()
    {
        return $this->hasMany(\Modules\Attendance\Entities\Attendance::class);
    }
}
