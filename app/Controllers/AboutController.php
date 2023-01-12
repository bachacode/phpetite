<?php

namespace App\Controllers;

class AboutController extends Controller
{

    public function index(){
        return parent::view('about');
    }

    public function edit(){
        echo "this is the edit";
    }
    public function destroy()
    {
        echo "this is destroy" . $_SERVER["REQUEST_METHOD"];
    }
}