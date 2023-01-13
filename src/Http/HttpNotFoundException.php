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

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function check($action)
    {
        if(is_null($action))
        {
            throw new HttpNotFoundException(self::__toString());
        }
        if ($action && is_callable($action))
        {
            $action();
        }
    }
}