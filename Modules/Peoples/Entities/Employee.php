<?php

namespace Modules\Peoples\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'email',
        'address',
        'identity',
        'identity_file',
        'passport',
        'passport_file',
        'license',
        'license_file',
        'type',
        'description',
        'image',
        'deleted_at',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function users(){
        return  $this->hasMany(\App\Models\User::class);
    }
}
