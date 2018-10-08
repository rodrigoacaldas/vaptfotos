<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFoto extends Model
{
    protected $fillable = [
        'nome', 'descricao',
    ];

    protected $guarded = [
        'id'
    ];

    public function evento()
    {
        return $this->hasMany(Evento::class);
    }
}
