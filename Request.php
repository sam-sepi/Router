<?php

namespace Router;

/** 
 *  @class      Request
 *  
 *  Request handle
 */
class Request
{
    /**
     * @fn getProtocol
     *  
     * Name and revision of the information protocol via 
     * which the page was requested; e.g. 'HTTP/1.0'; 
     * 
     * @return string
     */
    public static function getProtocol(): string
    {
        return strtolower($_SERVER['SERVER_PROTOCOL']);
    }

    /**
     * @fn getIPAddress 
     * 
     * Client IP
     * 
     * @return string
     */
    public static function getIPAddress(): string
    {
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        
        else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        
        else
            $ipaddress = '127.0.0.1';
        
        return $ipaddress;
    }

    /**
     * @fn getUserAgent 
     * 
     * User Agent Client
     * 
     * @return mixed
     */
    public static function getUserAgent(): string
    {
        return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ' ';
    }

    /**
     * @fn getMethod 
     * 
     * Which request method was used to access the page; e.g. 'GET', 'HEAD', 'POST', 'PUT'.
     * 
     * @return string
     */
    public static function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @fn getURI 
     * 
     * The URI which was given in order to access this page; 
     * for instance, '/index.html'.
     * 
     * @return string
     */
    public static function getURI(): string
    {
        return strtolower($_SERVER['REQUEST_URI']);
    }

    /**
     * @fn getHeader
     *
     * Fetches all HTTP headers from the current request.
     * 
     * @param  string $header
     * @return string|null
     */
    public static function getHeader(string $header)
    {
        $headers = getallheaders();
            
        if(isset($headers[$header]))
        {
            return $headers[$header];
        }
    }

    /**
     * @fn getParsedURL
     * 
     * return url parsed
     * https://www.php.net/manual/en/function.parse-url.php
     * 
     * scheme - e.g. http
     * host
     * port
     * user
     * pass
     * path
     * query - after the question mark ?
     * fragment - after the hashmark #
     * 
     * @return array
     */
    public static function getParsedURL(): array
    {
        return parse_url('http://' . $_SERVER['HTTP_HOST'] . self::getURI());
    }

    /**
     * @fn getQueryParams
     * 
     * return request query params
     * 
     * @return string
     */
    public static function getQueryParams(): string
    {
        return strtolower($_SERVER['QUERY_STRING']);
    }

    /**
     * @fn getQueryParamsLikeArray
     * 
     * return query params like array
     * 
     * Ex.: http://localhost/Router/test.php?id=2
     * Array ( [id] => 2 )
     *
     * @return array
     */
    public static function getQueryParamsLikeArray(): array
    {
        $params = [];

        if(self::getQueryParams() != null)
        {
            parse_str(self::getQueryParams(), $params);
        }

        return $params;
    }

    /**
     * getSanitizedArrayParams
     * 
     * TODO implements PUT and DELETE meth. eventually
     *
     * @return array
     */
    public static function getSanitizedArrayParams(): array
    {
        if(self::getMethod() == 'get')
        {
            $params = self::getQueryParamsLikeArray();

            foreach($params as $key => $value)
            {
                $params[$key] = filter_var($value, FILTER_SANITIZE_STRING);
            }
        }
        else if(self::getMethod() == 'post')
        {
            $params = self::getPostData();

            foreach($params as $key => $value)
            {
                $params[$key] = filter_var($value, FILTER_SANITIZE_STRING);
            }
        }

        return $params;
    }

    /**
     * @fn getPostData
     *
     * @param boolean $json
     * @return array
     */
    public static function getPostData(bool $json = false): array
    {
        $data = [];

        if($json)
        {
            $rawdata = json_decode(file_get_contents('php://input'));

            $data = json_decode($rawdata, true);
        }
        else
        {
            foreach ($_POST as $key => $value) 
            {
                $data[$key] = filter_var($value, FILTER_SANITIZE_STRING);
            }
        }

        return $data;
    }

    /**
     * @fn isAjax
     *
     * @return boolean
     */
    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }
}