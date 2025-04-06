<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class LoanRule extends Model
{
    protected $fillable = [
    	'loan_type_id',
        'date',
        'min_amount',
        'max_amount',
        'min_installments',
        'max_installments',
        'max_loan_per_year',
        'max_loans',
        'employee_id',
        'status',
    ];

    function loanType()
    {
    	return $this->belongsTo(LoanType::class);
    }

    function employee()
    {
        return $this->belongsTo(\Modules\Peoples\Entities\Employee::class);
    }
}
