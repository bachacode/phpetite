<?php

namespace App\Controllers;

use Petite\Routing\Route;
use App\Models\User;

class UserController extends Controller
{

    #[Route('/users')]
    public function index()
    {
        $user = new User();
        return $this->view('user', [
            'users' => $user->getAll(),
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