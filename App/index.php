<?php
require 'vendor/autoload.php';
 require 'core/bootstrap.php';

 use App\Core\{Router,Request};

//$todos = App::get('database')->selectAll('todos');


 Router::load('routes.php')->direct(Request::method(),Request::uri());




