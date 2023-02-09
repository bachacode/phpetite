<?php

namespace Petite\Database;

use Petite\App;

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
