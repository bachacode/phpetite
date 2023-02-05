<?php

namespace Petite\Database;

use PDO;

class DB
{
    private PDO $pdo;

    public function __construct(protected array $config)
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            $this->pdo = new PDO(
                $config['connection'] .
                ':host=' . $config['host'] .
                ';dbname=' . $config['name'],
                $config['user'],
                $config['pass'],
                $config['options'] ?? $defaultOptions
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }
}
