<?php

namespace Router;

use InvalidArgumentException;

use Router\Session;

class Response
{
    public $route;
    public $params;

    public function __construct(string $route, array $params)
    {
        $this->route = $route;
        $this->params = $params;
    }

    /**
     * @fn getContent
     *
     * @return void
     */
    public function getContent()
    {
        echo $this->render(Config::HOST . Config::ROUTES_ALLOWED[$this->route][0], $this->params);
    }

    /**
     * @fn render
     *
     * @param string $path
     * @return void
     */
    protected function render(string $path, array $data)
    {
        if(file_exists($path))
        {
            ob_start();
            
            switch($this->route)
            {
                case '401':
                    http_response_code(401);
                break;
                
                case '405':
                    http_response_code(405);
                break;
            }

            include $path;
            
            return ob_get_clean();
        } 
        else throw new InvalidArgumentException('FILE NOT FOUND');
    }
}