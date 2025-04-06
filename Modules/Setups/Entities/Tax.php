<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
    	'date',
        'starter',
        'starter_for_male',
        'starter_for_female',
        'desc',
        'status',
    ];

    public function rules()
    {
    	return $this->hasMany(TaxRule::class);
    }
}
