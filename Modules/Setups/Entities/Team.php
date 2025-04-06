<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $fillable = [
    	'name',
    	'sub_function_id',
        'desc',
        'status',
    ];

    function employees()
    {
        return $this->hasMany(\Modules\Peoples\Entities\Employee::class);
    }

    function subFunction()
    {
    	return $this->hasOne(SubFunction::class,'id','sub_function_id');
    }
}
