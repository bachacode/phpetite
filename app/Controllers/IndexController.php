<?php

namespace App\Controllers;

class IndexController
{
    public function index(){
        require dirname(__DIR__) . '/Views/index.view.php';
    }
}