<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cpd extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'numero_serial', 'data_instalacao'
    ];
    
    public function leituras()
    {
        return $this->hasMany('App\Leitura');
    }
}
