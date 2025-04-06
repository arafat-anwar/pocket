<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class TrusteeBoardMember extends Model
{
    protected $fillable = [
    	'trustee_board_id',
        'employee_id',
        'position',
        'desc',
        'status',
    ];

    function trusteeBoard()
    {
    	return $this->belongsTo(TrusteeBoard::class);
    }

    function employee()
    {
        return $this->belongsTo(\Modules\Peoples\Entities\Employee::class);
    }
}
