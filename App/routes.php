<?php




$router->get('','PageController@home');
$router->get('about','PageController@about');
$router->get('contact','PageController@contact');
$router->get('about/culture','PageController@culture');
$router->post('task','PageController@task');

//var_dump($router);
