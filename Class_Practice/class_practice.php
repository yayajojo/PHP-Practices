<?php
//class practice ->instationate -> object

class Team
{
 protected $name;

 protected $members;

 public function __construct($name,$members=[])
 {
     $this->name = $name;
     $this->members = $members;
 }

public static function create($name,$members=[])
{
  return new static($name,$members);
}

 public function add($name)
 {
   $this->members[] = $name; 
 }


}


$acam = new Team("acam");
$acam->add('Lisa');
$berry = Team::create("berry",["Jhao","Mary"]);
var_dump($acam);
var_dump($berry);