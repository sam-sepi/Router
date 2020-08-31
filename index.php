<?php

include('vendor/autoload.php');


$router = new Router\Router(Router\Request::getParsedURL(), function($route, $params)
{
    
    //methods allowed
    if(!in_array(Router\Request::getMethod(), Router\Config::METHODS_ALLOWED)) 
    { 
        $route = '405';
    }

    //permission
    $session = new Router\Session;

    if((Router\Config::ROUTES_ALLOWED[$route][1] > 0) && ($session->role < Router\Config::ROUTES_ALLOWED[$route][1]))
    {
        $route = '401';
    }

    $response = new Router\Response($route, $params);
    
    echo $response->getContent();

});
