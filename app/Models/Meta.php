<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{

    protected $guarded = [
        'id'
    ];

    public function cliente()
    {
        return $this->hasMany(Cliente::class);
    }
}
