# Router

PHP Class for routing

# Get Started

```
git clone https://github.com/sam-sepi/Router.git
```

# Usage

**.htacess** file:

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

```

#### The **configuration parameters** are found in the **Config.php** file: the allowed http methods, the accessible routes, the permissions based on the role registered in the session.

```php
class Config
{
    const HOST = "http://localhost/";
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
        'send' => ['Router/views/send.html', 1] //post method
    ];

    /**
     * Session Params
     */
    const SESSION_PARAMS =
    [
        'cookie_httponly' => 1, 
        'cookie_lifetime'  => 0
    ];
}
```

#### **Router** in **index.php** file:

```php
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
```

#### Class Content for *content* example.

# Author

Sam Sepi - Initial work

# License

This project is licensed under the MIT License