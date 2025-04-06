<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class TrusteeBoard extends Model
{
    protected $fillable = [
    	'legal_entity_id',
        'name',
        'desc',
        'status',
    ];

    function members()
    {
        return $this->hasMany(TrusteeBoardMember::class);
    }

    function legalEntity()
    {
    	return $this->belongsTo(LegalEntity::class);
    }
}
