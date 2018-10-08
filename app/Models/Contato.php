<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $guarded = [
        'id'
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }

    public function meioContato()
    {
        return $this->belongsTo(MeioContato::class, 'meiocontato_id');
    }
}
