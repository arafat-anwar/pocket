<?php

namespace Modules\Language\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'code',
        'name',
        'direction',
        'flag',
        'deleted_at',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    function libraries(){
        return $this->hasMany(LanguageLibrary::class);
    }
}
