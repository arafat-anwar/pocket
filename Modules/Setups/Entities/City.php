<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'country_id',
        'code',
        'name',
        'description',
        'deleted_at',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function users(){
        return $this->hasMany(\App\Models\User::class);
    }
}
