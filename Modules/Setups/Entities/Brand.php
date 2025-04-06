<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
    	'name',
        'address',
        'contact_info',
        'image',
        'desc',
        'status',
    ];

    function employees()
    {
    	return $this->hasMany(\Modules\Peoples\Entities\Employee::class);
    }

    function legalEntities()
    {
        return $this->hasMany(\Modules\Setups\Entities\legalEntity::class,'brand_id','id');
    }
}
