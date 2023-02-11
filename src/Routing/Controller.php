<?php

namespace Petite\Routing;

use Petite\View\View;
use Petite\View\ViewEngine;

class Controller
{
    public ViewEngine $viewEngine;

    public function __construct(?string $viewPath, ?string $layoutPath)
    {
        if (!$viewPath || !$layoutPath) {
            $this->viewEngine = new ViewEngine();
        } else {
            $this->viewEngine = new ViewEngine($viewPath, $layoutPath);
        }
    }

    public function view(string $file, array $params = [], ?string $layout = "default"): string
    {
        $view = new View($file, $params, $layout);
        return $this->viewEngine->render($view);
    }
}
