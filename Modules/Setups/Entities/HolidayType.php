<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class HolidayType extends Model
{
    protected $fillable = [
    	'name',
        'desc',
        'status',
    ];

    function holidays()
    {
        return $this->hasMany(Holiday::class);
    }
}
