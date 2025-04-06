<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class AttendanceBasedSalaryHead extends Model
{
    protected $fillable = [
    	'name',
        'type',
        'desc',
        'status',
    ];

    function details()
    {
        return $this->hasMany(AttendanceBasedSalaryHeadDetail::class,'salary_head_id','id');
    }
}
