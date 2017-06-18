<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cpd extends Model {

    public $timestamps = false;
    protected $fillable = [
        'numero_serial', 'data_instalacao'
    ];

    public function leituras() {
        return $this->hasMany('App\Leitura');
    }

    public function getDataInstalacaoAttribute($value) {
        $time = strtotime($value);

        if (!$time) {
            return '';
        }

        return date('d/m/Y', $time);
    }

    public function setDataInstalacaoAttribute($value) {
        $partesData = explode('/', $value);
        
        if (count($partesData) != 3) {
            return;
        }

        $data = $partesData[2] . '-' . $partesData[1] . '-' . $partesData[0];
        
        if(!strtotime($data)){
            return;
        }
        
        $this->attributes['data_instalacao'] = $data;
    }
    
    public function jsonLeituras(){
        $pontos = [];
        
        foreach($this->leituras as $leitura){
            $ponto = [
                'x' => $leitura->horario,
                'y' => $leitura->temperatura
            ];
            
            $pontos[] = $ponto;
        }
        
        return json_encode($pontos);
    }

}
