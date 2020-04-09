<?php

use App\Core\App;
use App\Core\Database\Connection;
use App\Core\Database\QueryBuilder;

App::bind('config', require 'config.php');
// require 'core/database/Connection.php';
// require 'core/database/QueryBuilder.php';
// require 'core/Router.php';
// require 'core/Request.php';

App::bind('database',new QueryBuilder(Connection::make(App::get('config'))));

function view($page,$data=[]){
    extract($data);
    return require "views/{$page}.view.php";
}