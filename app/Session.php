<?php

namespace App;

class Session{
    public static function logarUsuario(Usuario $usuario){
        $_SESSION['usuario'] = $usuario;
    }
    
    public static function obterUsuario(){
        return $_SESSION['usuario'];
    }
    
}