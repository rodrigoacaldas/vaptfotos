<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCancelamento extends Model
{
    protected $fillable = [
        'nome', 'descricao',
    ];

    protected $guarded = [
        'id'
    ];

    public function cancelamento()
    {
        return $this->hasMany(Cancelamento::class);
    }
}
