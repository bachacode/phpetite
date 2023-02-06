<?php

namespace App\Controllers;

use Petite\Routing\Route;

class AboutController extends Controller
{
    #[Route('/about')]
    public function index()
    {
        return parent::view('about');
    }
}
