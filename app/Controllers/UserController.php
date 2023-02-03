<?php

namespace App\Controllers;

use Petite\Routing\Route;
use App\Models\User;
use Petite\Container\Container;

class UserController extends Controller
{
    public function __construct(private User $user)
    {    
    }

    #[Route('/users')]
    public function index()
    {
        return $this->view('user', [
            'users' => $this->user->getAll(),
        ]);
    }

    #[Route('/users/store', 'POST')]
    public function store()
    {
        $user = new User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->insert();
        header('Location: /users');
        die();
    }
}