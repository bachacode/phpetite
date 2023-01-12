<?php

namespace App\Controllers;

class ContactController extends Controller
{
    public function index(){
        return parent::view('contact');
    }
}