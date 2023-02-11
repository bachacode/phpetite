<?php

namespace Petite\View;

use Petite\View\ViewNotFoundException;

class ViewEngine
{
    public function __construct(
        protected readonly string $viewPath = VIEW_PATH,
        protected readonly string $layoutPath = LAYOUT_PATH,
        protected readonly string $contentSlot = "{{content}}"
    ) {
    }

    public function render(View $view): string
    {
        $viewContent = $this->getView($view->file, $view->data);
        if (!$view->layout) {
            return $viewContent;
        }
        $layoutContent = $this->getLayout($view->layout);
        return str_replace($this->contentSlot, $viewContent, $layoutContent);
    }

    private function getView(string $view, array $params): string
    {
        return $this->getContentFile($this->viewPath . $view . ".view.php", $params);
    }

    private function getLayout(string $layout): string
    {
        return $this->getContentFile($this->layoutPath . $layout . ".view.php");
    }

    private function getContentFile(string $filePath, array $data = []): string
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
