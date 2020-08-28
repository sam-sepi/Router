<?php

include('vendor/autoload.php');

$router = new Router\Router(Router\Request::getParsedURL(), function($route, $params)
{
    $response = new Router\Response($route, $params);

    if(Router\Request::getMethod() == 'get')
    {
        echo $response->getContent();
    }

});
