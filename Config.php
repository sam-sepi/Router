<?php

namespace Router;

class Config
{
    const HOST = "/opt/lampp/htdocs/";
    const METHODS_ALLOWED = ['get', 'post']; //TO DO eventually PUT and DELETE meth.

    //roles
    const USER = 0;
    const PUBLISHER = 1;
    const ADMIN = 2;

    /**
     * array = ['route' => ['path', 'permission'];
     */
    const ROUTES_ALLOWED = 
    [
        'index' => ['Router/views/index.html', 0],
        '401' => ['Router/views/401.html', 0],
        '405' => ['Router/views/405.html', 0],
        'article' => ['Router/views/content.php', 0],
        'send' => ['Router/views/sendcontent.php', 1] //post method
    ];

    const SESSION_PARAMS =
    [
        'cookie_httponly' => 1, 
        'cookie_lifetime'  => 0
    ];
}