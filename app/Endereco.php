<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'logradouro', 'numero', 'cidade', 'estado', 'bairro', 'cep'
    ];

}
