<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    protected $fillable = [
    	'name',
    	'interval',
        'desc',
        'status',
    ];

    function rules()
    {
    	return $this->hasMany(LoanRule::class);
    }
}
