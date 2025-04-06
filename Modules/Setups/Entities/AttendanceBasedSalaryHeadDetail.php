<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class AttendanceBasedSalaryHeadDetail extends Model
{
    protected $fillable = [
    	'salary_head_id',
        'date',
        'unit_for_absent',
        'percentage_from',
        'percentage',
        'desc',
        'status',
    ];

    function attendanceBasedSalaryHead()
    {
        return $this->hasOne(AttendanceBasedSalaryHead::class,'id','salary_head_id');
    }

    function monthlyPayrolls()
    {
        return $this->hasMany(\Modules\Payroll\Entities\MonthlyPayrollAttendanceBasedHead::class);
    }
}
