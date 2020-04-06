<?php
//var_dump($_SERVER['REQUEST_URI']);
use App\Core\App;

$result = App::get('database')->insertOne($_POST,'todos');

header('Location: /');