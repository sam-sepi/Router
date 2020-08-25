<?php

include('vendor/autoload.php');

$router = new Router\Router(Router\Request::getUri(), function($route)
{
    echo $route;
});
