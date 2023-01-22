<?php

namespace App\Controllers;
use Petite\Routing\Route;

class ContactController extends Controller
{
    #[Route('/contact')]
    public function index(){
        return parent::view('contact');
    }
}