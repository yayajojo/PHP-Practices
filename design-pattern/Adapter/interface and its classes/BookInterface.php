<?php

namespace App\Interfaces;

interface BookInterface
{
    public function open();
    public function turnPage();
}   

class Book implements BookInterface
{
  public function open()
  {
      var_dump('opening a book');
  }
  public function turnPage()
  {
      var_dump('turning the page!');
  }

}