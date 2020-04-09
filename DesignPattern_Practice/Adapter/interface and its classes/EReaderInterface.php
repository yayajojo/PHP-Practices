<?php

namespace App\Interfaces;

interface EReaderInterface
{
    public function turnOn();
    public function pressNextBtn();
}

class Kindle implements EReaderInterface
{
    public function turnOn()
    {
     var_dump('turning on the kindle!');
    }
    public function pressNextBtn()
    {
     var_dump('press the button to the next page!');
    }
}