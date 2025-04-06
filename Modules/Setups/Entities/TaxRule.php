<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class TaxRule extends Model
{
    protected $fillable = [
    	'tax_id',
        'amount_from',
        'amount_to',
        'tax_percentage',
        'desc',
        'status',
    ];

    public function tax()
    {
    	return $this->belongsTo(Tax::class);
    }

    function monthlyPayrolls()
    {
        return $this->hasMany(\Modules\Payroll\Entities\MonthlyPayroll::class);
    }
}
