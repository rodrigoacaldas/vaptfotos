<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opcao extends Model
{
    protected $fillable = [
        'semRetorno', 'proximosDias',
    ];

    protected $guarded = [
        'id'
    ];
}
