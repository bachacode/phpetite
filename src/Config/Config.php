<?php

namespace Petite\Config;

/**
 * @property-read ?array $db
 */
class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'connection' => $env['DB_CONNECTION'] ?? 'mysql',
                'host' => $env['DB_HOST'],
                'name' => $env['DB_NAME'],
                'user' => $env['DB_USER'],
                'pass' => $env['DB_PASS']
            ]
        ];
    }

    public function __get(string $name): array
    {
        return $this->config[$name] ?? null;
    }
}
