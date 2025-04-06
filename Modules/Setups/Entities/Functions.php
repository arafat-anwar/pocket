<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{
    protected $fillable = [
    	'name',
        'desc',
        'status',
    ];

    function employees()
    {
    	return $this->hasMany(\Modules\Peoples\Entities\Employee::class,'function_id','id');
    }

    function subFunctions()
    {
    	return $this->hasMany(SubFunction::class,'function_id','id');
    }

    function projects()
    {
        return $this->hasMany(\Modules\PMD\Entities\Project::class, 'function_id', 'id');
    }

    function associateProjects()
    {
        return $this->hasMany(\Modules\PMD\Entities\ProjectFunction::class, 'function_id', 'id');
    }

    public function categories(){
        return $this->hasMany(\Modules\Purchase\Entities\CategoryFunction::class, 'function_id', 'id');
    }
}
