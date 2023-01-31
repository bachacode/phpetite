<?php

namespace Petite\Http;

use Exception;

class HttpNotFoundException extends Exception
{
    protected $message = "Not Found";
    protected $code = 404;
}