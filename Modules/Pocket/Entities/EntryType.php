<?php

namespace Modules\Pocket\Entities;

use Illuminate\Database\Eloquent\Model;

class EntryType extends Model
{
    protected $fillable = [
    	'name',
        'sign',
        'color',
        'desc',
        'status',
    ];

    function entries(){
        return $this->hasMany(Entry::class);
    }
}
