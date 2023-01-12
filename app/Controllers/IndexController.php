<?php

namespace App\Controllers;

class IndexController extends Controller
{
    public function index(){
        return parent::view('index');
    }
}