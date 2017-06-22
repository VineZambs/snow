<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cpd extends Model {

    public $timestamps = false;
    protected $fillable = [
        'numero_serial', 'data_instalacao', 'umidade_max', 'temperatura_max', 'umidade_min', 'temperatura_min'
    ];

    public function leituras() {
        return $this->hasMany('App\Leitura');
    }

    public function empresa() {
        return $this->belongsTo('App\Empresa');
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

}
