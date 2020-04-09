<?php

use App\Interfaces\BookInterface;
use App\Interfaces\EReaderInterface;



class EReaderAdapter implements BookInterface
{
    protected $ereader;

    public function __construct(EReaderInterface $ereader)
    {
        $this->ereader = $ereader;
    }
    public function open()
    {
        $this->ereader->turnOn();
    }
    public function turnPage()
    {
        $this->ereader->pressNextBtn();
    }
}