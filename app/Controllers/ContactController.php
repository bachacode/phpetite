<?php

namespace App\Controllers;



class ContactController
{
    public function index(){
        require dirname(__DIR__) . '/Views/index.view.php';
    }
}