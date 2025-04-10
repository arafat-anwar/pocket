<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'status',
    ];

    function employees()
    {
    	return $this->hasMany(\Modules\Peoples\Entities\Employee::class);
    }
}
