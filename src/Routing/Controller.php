<?php

namespace Petite\Routing;

use Petite\View\View;

class Controller
{
    public function view(string $view, array $data = []): string
    {
        return (string) View::make($view, $data);
    }
}