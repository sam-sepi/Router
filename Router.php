<?php

namespace Router;

class Router
{
    //http methods allowed
    protected $methodAllowed = ['get', 'post'];

    //route
    protected $route;

    //callable fn
    protected $callback;

    public function __construct(string $route, callable $callback)
    {
        $this->route = $route;
        $this->callback = $callback;
    }
    
    /**
     * @fn methodAllowed
     *
     * @return void
     */
    public function methodAllowed()
    {
        if(!in_array(Request::getMethod(), $this->methodAllowed))
        {
            header("HTTP/1.1 405 Method Not Allowed", true, 405);
            exit();
        }
    }

    /**
     * @fn getSanitizedParams
     *
     * @return array
     */
    public function getSanitizedParams(): array
    {
        return Request::getSanitizedArrayParams();
    }

    /**
     * @fn isAjax
     *
     * @return boolean
     */
    public function isAjax():bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    /**
     * _desctruct
     */
    public function __destruct()
    {
        call_user_func($this->callback, $this->route);
    }
}
