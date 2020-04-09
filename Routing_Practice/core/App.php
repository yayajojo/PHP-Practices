<?php
namespace App\Core;

class App{
    protected static $registry = []; 
    public static function bind($key,$val){
     static::$registry[$key]=$val;
    }
    public static function get($key){
        if(array_key_exists($key,static::$registry)){
        return static::$registry[$key];
        }
        throw new Exception("No {$key} bound for the container!");
        
    }
}