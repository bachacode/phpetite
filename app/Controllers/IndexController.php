<?php

namespace App\Controllers;

use Petite\App;
use Petite\Routing\Route;

class IndexController extends Controller
{

    #[Route('/')]
    public function index()
    {
        $db = App::db();

        return $this->view('index', ['foo' => 'bar']);
    }
}