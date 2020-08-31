<?php

namespace Router;

class Session 
{
    /**
     * @fn construct 
     * 
     */
    public function __construct() 
    {
        if(session_status() == PHP_SESSION_NONE) 
        {
            session_start(Config::SESSION_PARAMS);
        }
    }
   
    /**
     * @fn __set
     *
     * Ex.: $session->username = $username;
     */
    public function __set(string $name, $value)
    {
        $_SESSION[$name] = $value;
    }
   
   
    /**
     * @fn __get 
     * 
     * Ex.: echo $session->username;
     */
    public function __get(string $name)
    {
        if(isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }
   
    /**
     * @fn destroy 
     * 
     * Ex.: $session->destroy();
     */
    public function destroy()
    {
        session_destroy();
    }

    /**
     * @fn regenerate
     * 
     * @Ex.: $session->regenerate();
     */
    public function regenerate()
    {
        session_regenerate_id();
    }

     /**
     * @fn setSession
     * ex: 
     * 
     * Session::setSession(
     *      [
     *          'name' => 'John Doe',
     *          'role' => 1
     *      ]
     * );
     * 
     * @param array $session
     * @return void
     */
    public function setSession(array $data)
    {
        foreach($data as $key => $value)
        {
            (is_string($value) || is_array($value) || is_int($value))

                ? ($_SESSION[$key] = filter_var($value, FILTER_SANITIZE_STRING))

                : false;
        }
    }

    /**
     * @fn getSession
     *
     * @return array
     */
    public function getSession(): array
    {
        return (count($_SESSION) > 0) ? $_SESSION : [];
    }
}