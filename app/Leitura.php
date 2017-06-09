<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{
    public $timestamps = false;
    protected $table = 'leitura_cpd';

    protected $fillable = [
        'temperatura', 'humidade', 'horario'
    ];
}
