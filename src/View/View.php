<?php

namespace Petite\View;

class View
{
    public function __construct(
        public string $file,
        public array $data = [],
        public ?string $layout = 'default',
    ) {
    }

    public function __get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }
}
