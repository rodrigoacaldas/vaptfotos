<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Evento extends Model
{
    protected $guarded = [
        'id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tipoEvento()
    {
        return $this->belongsTo(TipoEvento::class, 'tipoeventos_id');
    }

    public function tipoFoto()
    {
        return $this->belongsTo(TipoFoto::class, 'tipofotos_id');
    }

    public function qtdConvidado()
    {
        return $this->belongsTo(QtdConvidado::class, 'qtdconvidados_id');
    }

    public function qtdFotos()
    {
        return $this->belongsTo(QtdFoto::class, 'qtdfotos_id');
    }

    public function contato()
    {
        return $this->hasMany(Contato::class);
    }

    public function ultimoContato()
    {
        return $this->hasOne(Contato::class)->latest();
    }

    public function cancelamento()
    {
        return $this->hasOne(Cancelamento::class)->latest();
    }
}
