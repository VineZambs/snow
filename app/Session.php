<?php

namespace App;

class Session{
    public static function login(Usuario $usuario){
        $_SESSION['usuario'] = $usuario;
    }
    
    public static function user(){
        return $_SESSION['usuario'];
    }
    
    public static function logout(){
        $_SESSION['usuario'] = null;
        
        session_destroy();
    }
    
}