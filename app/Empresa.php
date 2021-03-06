<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'razao_social', 'cnpj'
    ];

    protected $hidden = [
        'password',
    ];
    
    public function endereco()
    {
        return $this->hasOne('App\Endereco');
    }
    
    public function cpds()
    {
        return $this->hasMany('App\Cpd');
    }
    
    public function usuario() {
        return $this->belongsTo('App\Usuario');
    }
}
