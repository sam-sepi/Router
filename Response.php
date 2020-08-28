<?php

namespace Router;

use InvalidArgumentException;

class Response
{
    public $methodsAllowed = ['get', 'post'];

    public function __construct(string $route, array $params)
    {
        $this->route = $route;
        $this->params = $params;
    }

    /**
     * @setMethodsAllowed
     *
     * @param string $method
     * @return void
     */
    public static function setMethodsAllowed()
    {
        if(!in_array(Request::getMethod(), $this->methodsAllowed))
        {
            ob_start();
                HttpStatus::getHttpHeader(405);
                echo $this->render(Config::HOST . 'Router/views/405.html');
            return ob_get_clean();
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getContent()
    {
        echo $this->render(Config::HOST . $this->route, $this->params);
    }

    /**
     * Undocumented function
     *
     * @param string $path
     * @return void
     */
    public function render(string $path, array $data)
    {
        if(file_exists($path))
        {
            ob_start();
            
            HttpStatus::getHttpHeader(200);
            
            include $path;
            
            return ob_get_clean();
        } 
        else throw new InvalidArgumentException('File not found');
    }
}