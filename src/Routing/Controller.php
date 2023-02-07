<?php

namespace Petite\Routing;

use Petite\View\View;

class Controller
{
    public function view(
        string $view,
        array $params = [],
        string $layout = "default",
        string $contentSlot = "{{content}}",
        string $viewPath = VIEW_PATH,
        string $layoutPath = LAYOUT_PATH
        ): string
    {
        return (string) View::make(
            $view,
            $params,
            $layout,
            $contentSlot,
            $viewPath,
            $layoutPath
        );
    }
}
