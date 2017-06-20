<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{
    public $timestamps = false;
    protected $table = 'cpd_leitura';

    protected $fillable = [
        'temperatura', 'umidade', 'horario'
    ];
}
