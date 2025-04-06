<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class PublishmentType extends Model
{
    protected $fillable = [
    	'name',
        'desc',
        'status',
    ];

    public function publishments()
    {
    	return $this->hasMany(\Modules\Publishment\Entities\Publishment::class);
    }
}
