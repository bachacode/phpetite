<?php

namespace Petite\View;

use Petite\View\ViewNotFoundException;

class ViewEngine
{
    protected string $contentSlot = "{{content}}";
    protected string $viewPath = VIEW_PATH;
    protected string $layoutPath = LAYOUT_PATH;

    protected function getView(string $view, array $params): string
    {
        return $this->getContentFile($this->viewPath . $view . ".view.php", $params);
    }

    protected function getLayout(string $layout): string
    {
        return $this->getContentFile($this->layoutPath . $layout . ".view.php");
    }

    protected function getContentFile(string $filePath, array $data = []): string
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
 
        if (!file_exists($filePath)) {
            throw new ViewNotFoundException();
        }

        ob_start();
        include $filePath;
        $content = (string) ob_get_contents();
        ob_end_clean();
        return $content;
    }

}