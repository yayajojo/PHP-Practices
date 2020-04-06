<?php

namespace App\Core;
use Exception;

class Router
{

public $routers = ['GET'=>[],'POST'=>[]];


public function direct($requestType,$uri){
 if(!array_key_exists($uri,$this->routers[$requestType])){
    throw new Exception("No route was found for the {$uri} !"); 
 }
 $this->callAction(...explode('@',$this->routers[$requestType][$uri]));
}


public static function load($file){
    $router = new static;
    require $file;
    return $router;
}

public function get($uri,$controller){
    $this->routers['GET'][$uri]= $controller;
}

public function post($uri,$controller){
    $this->routers['POST'][$uri] = $controller;
}

protected function callAction($controllerClass,$action){
    $controller = "App\\Controllers\\{$controllerClass}";
    $controller = new $controller;
    if(!method_exists($controller,$action)){
      throw new Exception("NO such action {$action} was found in {$controllerClass}");
    }

    return $controller->$action();
}
}