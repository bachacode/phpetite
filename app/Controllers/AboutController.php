<?php

namespace App\Controllers;
use Petite\Routing\Route;

class AboutController extends Controller
{

    #[Route('/about')]
    public function index(){
        return parent::view('about');
    }

    #[Route('/about/edit')]
    public function edit(){
        echo "this is the edit";
    }

    #[Route('/about/destroy', 'DELETE')]
    public function destroy()
    {
        echo "this is destroy" . $_SERVER["REQUEST_METHOD"];
    }
}