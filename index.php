<?php

include('vendor/autoload.php');

$router = new Router\Router(Router\Request::getParsedURL(), function($route, $params)
{
    $response = new Router\Response($route, $params);
    
    echo $response->getContent();

});
