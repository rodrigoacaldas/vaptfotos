<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $guarded = [
        'id'
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
    public function meioContato()
    {
        return $this->belongsTo(MeioContato::class, 'meiocontato_id');
    }

}
