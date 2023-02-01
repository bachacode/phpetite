<?php

namespace Petite\Http;

use Exception;

class HttpNotFoundException extends Exception
{
    protected $message = "Page Not Found";
    protected $code = 404;
}