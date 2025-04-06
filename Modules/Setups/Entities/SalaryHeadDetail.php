<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class SalaryHeadDetail extends Model
{
    protected $fillable = [
    	'salary_head_id',
        'date',
        'percentage',
        'taxable',
        'yearly_tax_examption',
        'desc',
        'status',
    ];

    function salaryHead()
    {
    	return $this->belongsTo(SalaryHead::class);
    }

    function monthlyPayrolls()
    {
        return $this->hasMany(\Modules\Payroll\Entities\MonthlyPayrollHead::class);
    }
}
