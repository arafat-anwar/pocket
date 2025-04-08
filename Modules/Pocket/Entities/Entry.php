<?php

namespace Modules\Pocket\Entities;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
    	'user_id',
        'entry_type_id',
        'title',
        'amount',
        'date',
        'status',
    ];

    function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    function type(){
        return $this->belongsTo(EntryType::class);
    }

    function entryType(){
        return $this->belongsTo(EntryType::class);
    }
}
