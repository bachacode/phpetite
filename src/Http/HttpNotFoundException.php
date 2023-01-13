<?php

namespace Petite\Http;

use Exception;
use Throwable;

class HttpNotFoundException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null) {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    static public function check($action)
    {
        if(is_null($action))
        {
            throw new HttpNotFoundException('Not Found', 404);
        }
        if ($action && is_callable($action))
        {
            $action();
        }
    }
}