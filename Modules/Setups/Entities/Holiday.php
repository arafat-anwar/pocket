<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
    	'holiday_type_id',
        'name',
        'date',
        'desc',
        'status',
    ];

    function holidayType()
    {
        return $this->belongsTo(HolidayType::class);
    }
}
