<?php

namespace App\Models;

use Petite\App;
use Petite\Database\DB;

abstract class Model 
{
    /**
     * @var \PDO $db
     */
    
    protected DB $db;

    public function __construct()
    {
        $this->db = App::db();
    }

}