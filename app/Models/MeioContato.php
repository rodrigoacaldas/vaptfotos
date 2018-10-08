<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeioContato extends Model
{
    protected $fillable = [
        'nome', 'descricao',
    ];

    protected $guarded = [
        'id'
    ];

    public function contato()
    {
        return $this->hasMany(Contato::class);
    }

    public function cliente()
    {
        return $this->hasMany(Cliente::class);
    }


}
