<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    const ADMIN = 2;
    const CLIENTE = 1;
    
    public $timestamps = false;

    protected $fillable = [
        'nome', 'cpf', 'rg', 'email', 'senha'
    ];

    public function endereco()
    {
        return $this->hasOne('App\Endereco');
    }

    public function empresa()
    {
        return $this->hasOne('App\Empresa');
    }
}
