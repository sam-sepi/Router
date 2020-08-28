<?php

namespace Router;

use \InvalidArgumentException;

class HttpStatus
{
    /**
     * HTTP 1.1 status messages based on code
     *
     * @link http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
     * 
     * @var array
     */
    protected static $http_messages = 
    [
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',

        // Successful 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',

        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',

        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
    ];

    /**
     * http protocol
     * 
     * @var string
     */
    protected static $protocol = 'HTTP 1.1';

    /**
     * @fn getHttpHeader
     *
     * @param integer $code
     * @return void
     */
    public static function getHttpHeader(int $code)
    {
        header(self::$protocol . self::getHttpMessage($code));
    }

    /**
     * @fn getHttpMessage
     *
     * @param integer $code
     * @return void
     */
    public function getHttpMessage(int $code)
    {
        if(in_array(self::$http_messages[$code], self::$http_messages))
        {
            return $code .' '. self::$http_messages[$code];
        }
        else
        {
            throw new InvalidArgumentException('Http code '.$code.' not found');
        }
    }
}