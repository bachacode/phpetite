<?php

namespace App\Controllers;

class IndexController
{
    public function index(){
        return dirname(__DIR__) . '/Views/index.view.php';
    }
}