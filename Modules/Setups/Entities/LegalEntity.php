<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class LegalEntity extends Model
{
    protected $fillable = [
    	'brand_id',
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

    function trusteeBoards()
    {
        return $this->hasMany(TrusteeBoard::class);
    }

    function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
