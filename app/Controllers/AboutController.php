<?php

namespace App\Controllers;

class AboutController
{

    public function index(){
        require dirname(__DIR__) . '/Views/about.view.php';
    }
    public function edit(){
        echo "this is the edit";
    }
    public function destroy()
    {
        echo "this is destroy" . $_SERVER["REQUEST_METHOD"];
    }
}