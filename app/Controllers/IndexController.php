<?php

namespace App\Controllers;

use Petite\Routing\Route;

class IndexController extends Controller
{

    #[Route('/')]
    public function index()
    {
        return $this->view('index', ['foo' => 'bar']);
    }
}