<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeCategory extends Model
{
	protected $table = 'employee_categories';
    protected $fillable = [
    	'name',
        'desc',
        'status',
    ];

    function employees()
    {
    	return $this->hasMany(\Modules\Peoples\Entities\Employee::class, 'category_id', 'id');
    }
}
