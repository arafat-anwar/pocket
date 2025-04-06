<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
    	'code',
        'name',
        'nationality',
        'desc',
        'status',
    ];

    function cities() {
    	return $this->hasMany(City::class);
    }
}
