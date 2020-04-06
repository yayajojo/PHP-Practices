<?php
namespace App\Controllers;
use App\Core\App;



class PageController{

public function home(){  
    return view('index',['todos' => App::get('database')->selectAll('todos')]);
}

public function about(){
    return view('about',['name'=>"JHAO"]);
}
public function contact(){
    return view('contact');
}
public function culture(){
    return view('about-culture', ['name' => 'Laracasts']);
}
public function task(){
    require "controllers/add-task.php";
}
}