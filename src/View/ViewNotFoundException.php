<?php

namespace Petite\View;

use Exception;

class ViewNotFoundException extends Exception
{
    /**
     * @var string $message
     */
    protected $message = "View Not Found";
}
