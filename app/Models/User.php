<?php

namespace App\Models;

use PDO;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 */

class User extends Model
{
    protected string $table = 'users';
    protected array $columns = [
        'id',
        'name',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];

    public function insert(): int
    {
        
        $stmt = $this->db->prepare('
            INSERT INTO users (id, name, email, password, created_at, updated_at) 
            VALUES (DEFAULT, :name, :email, :password, NOW(), NOW())'
        );
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
    
        $stmt->execute();
        return (int) $this->db->lastInsertId();
    }

    public function getAll(): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM users'
        );
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function __get($name): mixed
    {
        return $this->columns[$name] ?? null;
    }
}