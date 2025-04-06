<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class SeparationOption extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'status',
    ];
}
