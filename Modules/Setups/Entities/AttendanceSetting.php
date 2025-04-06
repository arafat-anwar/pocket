<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class AttendanceSetting extends Model
{
    protected $table = 'attendance_settings';
    protected $fillable = [
        'in_time_tolerance',
        'out_time_tolerance',
        'night_shift_starts_from',
    ];
}
