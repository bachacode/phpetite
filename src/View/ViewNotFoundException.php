<?php

namespace Petite\View;

use Exception;

class ViewNotFoundException extends Exception
{
    protected $message = "View Not Found";
}