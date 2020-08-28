<?php

namespace Router;

class Router
{
    /**
     * route
     *
     * @var string
     */
    protected $route;

    /**
     * routes allowed
     *
     * @var array
     */
    public static $routesAllowed = ['post', 'article'];

    /**
     * callable fn.
     *
     * @var fn
     */
    protected $callback;

    /**
     * query params
     *
     * @var array
     */
    protected $params = [];

    /**
     * __construct
     *
     * @param callable $callback
     * @param string $route
     */
    public function __construct(array $route, callable $callback)
    {
        $this->route = $this->setRoute($route);
        $this->params = $this->setQueryParams();
        $this->callback = $callback;
    }
    
    /**
     * @fn setRoute
     *
     * @param string $route
     * @return string
     */
    public function setRoute(array $route): string
    {
        $routes = explode('/', $route['path']);
        array_shift($routes);
        return (in_array(end($routes), self::$routesAllowed)) ? end($routes) : Config::MAIN_PAGE;
    }

    /**
     * @fn setQueryParams
     *
     * @return array
     */
    public function setQueryParams(): array
    {
        return Request::getSanitizedArrayParams();
    }

    /**
     * _desctruct
     */
    public function __destruct()
    {
        call_user_func($this->callback, $this->route, $this->params);
    }
}
