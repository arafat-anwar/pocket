<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'company_id',
        'code',
        'name',
        'from',
        'to',
        'objectives',
        'budget',
        'deliverables',
        'status',
    ];

    function company(){
        return $this->belongsTo(Company::class);
    }

    function postings(){
        return $this->hasMany(\Modules\Peoples\Entities\EmployeePosting::class, 'project_id', 'id');
    }

    function payrolls(){
        return $this->hasMany(\Modules\Payroll\Entities\ProjectPayroll::class);
    }
}
