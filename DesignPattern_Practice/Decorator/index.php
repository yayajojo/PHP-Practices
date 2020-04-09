<?php

require "vendor/autoload.php";

//1. decorators pattern

interface CarService
{

    public function getCost();
    public function getDescription();
}

class BasicInspection implements CarService
{
    

    public function __construct()
    {
        
    }

    public function getCost()
    {
       return 20 ;
    }

    public function getDescription()
    {
     return 'The fee includes basic inspection ' ;
    }

}

class OilChange implements CarService
{
    protected $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }

    public function getCost()
    {
       return 40 + $this->service->getCost();
    }

    public function getDescription()
    {
     return $this->service->getDescription().', and oil change';
    }

}



class TireRotation implements CarService
{
    protected $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }

    public function getCost()
    {
       return 30 + $this->service->getCost();
    }

    public function getDescription()
    {
     return $this->service->getDescription(). ', and a tire rotation';
    }

}




echo (new TireRotation(new OilChange(new BasicInspection)))->getDescription();
echo (new TireRotation(new OilChange(new BasicInspection)))->getCost();
echo (new TireRotation(new BasicInspection))->getDescription();
echo (new TireRotation(new BasicInspection))->getCost();






















