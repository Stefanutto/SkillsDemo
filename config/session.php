<?php
if (!isset($_SESSION)){
    session_start();
}

class Session{

    function __construct(){
        
    }

    public static function Set($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function Get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return "";
        }
        
    }

    public static function Unset(){
        session_unset();
    }

}