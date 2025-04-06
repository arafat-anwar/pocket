<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class SubFunction extends Model
{
	protected $able = 'sub_functions';

    protected $fillable = [
    	'name',
    	'function_id',
        'desc',
        'status',
    ];

    function teams()
    {
    	return $this->hasMany(Team::class);
    }

    function employees()
    {
        return $this->hasMany(\Modules\Peoples\Entities\Employee::class);
    }

    function thisFunction()
    {
    	return $this->hasOne(Functions::class,'id','function_id');
    }
}
