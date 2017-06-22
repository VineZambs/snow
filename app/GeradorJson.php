<?php

namespace App;

class GeradorJson
{
    public static function temperatura($leituras){
        $pontos = [];

        foreach($leituras as $leitura){
            $ponto = [
                'x' => $leitura->horario,
                'y' => $leitura->temperatura
            ];

            $pontos[] = $ponto;
        }

        return json_encode($pontos);
    }

    public static function umidade($leituras){
        $pontos = [];

        foreach($leituras as $leitura){
            $ponto = [
                'x' => $leitura->horario,
                'y' => $leitura->umidade
            ];

            $pontos[] = $ponto;
        }

        return json_encode($pontos);
    }
}
