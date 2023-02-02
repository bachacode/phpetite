<?php

namespace App\Controllers;

use PDO;
use Petite\Routing\Route;

class IndexController extends Controller
{

    #[Route('/')]
    public function index()
    {
        try {
            $db = new PDO(
                'mysql:host=localhost;
                dbname=phpetite_test', 
                'root', 
                ''
            );
            $query = 'SELECT * FROM users';
            $stmt = $db->query($query);
            $test = $stmt->fetchAll();
            print_r($test);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
        
        var_dump($db);
        return $this->view('index', ['foo' => 'bar']);
    }
}