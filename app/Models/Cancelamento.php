<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cancelamento extends Model
{
    public function cancelamento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }

    public function tipoCancelamento()
    {
        return $this->belongsTo(TipoCancelamento::class, 'tipocancelamento_id');
    }
}
