<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conheceu extends Model
{
    protected $fillable = [
        'nome', 'descricao',
    ];

    protected $guarded = [
        'id'
    ];

    public function cliente()
    {
        return $this->hasMany(Cliente::class);
    }
}
