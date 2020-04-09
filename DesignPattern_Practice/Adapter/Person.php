<?php


use App\Interfaces\BookInterface;

class Person 
{
     public function read(BookInterface $book){
       $book->open();
       $book->turnPage();
    } 
    
}



