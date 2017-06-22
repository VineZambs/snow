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
    
    public function cpd() {
        return $this->belongsTo('App\Cpd');
    }
    
    public function inadequada(){
        if($this->temperatura > $this->cpd->temperatura_max ||$this->temperatura < $this->cpd->temperatura_min){
            return true;
        }
        
        if($this->umidade > $this->cpd->umidade_max ||$this->umidade < $this->cpd->umidade_min){
            return true;
        }
        
        return false;
    }
}
