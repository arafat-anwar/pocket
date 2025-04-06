<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
    	'name',
    	'desc',
    	'status'
    ];

    public function issues(){
    	return $this->hasMany(\Modules\Issue\Entities\Issue::class);
    }
}
