<?php

namespace Router;

class Config
{
    const HOST = "/opt/lampp/htdocs/";
    const MAIN_PAGE = "Router/views/index.html";
    const ROUTES_ALLOWED = 
    [
        'article' => 'Router/views/content.php'
    ];
}