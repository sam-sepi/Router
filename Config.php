<?php

namespace Router;

class Config
{
    const HOST = "/opt/lampp/htdocs/";
    const MAIN_PAGE = "Router/views/index.html";
    const METHODS_ALLOWED = ['get', 'post']; //TO DO eventually PUT and DELETE meth.
    const ROUTES_ALLOWED = 
    [
        'article' => 'Router/views/content.php'
    ];
}