<?php

namespace Modules\Language\Entities;

use Illuminate\Database\Eloquent\Model;

class LanguageLibrary extends Model
{
    protected $fillable = [
        'language_id',
        'slug',
        'translation',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    function language(){
        return $this->belongsTo(Language::class);
    }
}
