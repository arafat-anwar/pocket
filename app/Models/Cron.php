<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cron extends Model
{
    protected $fillable = [
        'process', 'output'
    ];
}
