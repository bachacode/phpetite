<?php

namespace Petite\Routing;

use Petite\View\View;

class Controller
{
    public function view(string $view, array $params = [], string $layout = "default"): string
    {
        return (string) View::make($view, $params, $layout);
    }
}
