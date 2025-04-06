<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class JobLocation extends Model
{
    protected $fillable = [
    	'name',
        'lat',
        'long',
        'address',
        'desc',
        'status',
    ];

    function employees()
    {
    	return $this->hasMany(\Modules\Peoples\Entities\Employee::class);
    }
}
