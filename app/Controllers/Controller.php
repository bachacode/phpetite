<?php

namespace App\Controllers;

class Controller
{
    public static function view($view)
    {
        require dirname(__DIR__) . '/Views/'.$view.'.view.php';
    }
}