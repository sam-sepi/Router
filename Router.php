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
        return (array_key_exists(end($routes), Config::ROUTES_ALLOWED)) ? Config::ROUTES_ALLOWED[end($routes)] : Config::MAIN_PAGE;
    }

    /**
     * @fn setQueryParams
     * 
     * sanitize get or post params
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
