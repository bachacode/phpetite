<?php

namespace Petite\View;

use Petite\View\ViewNotFoundException;

class View
{
    public function __construct(
        protected string $view,
        protected array $data = [],
        protected string $layout = "default",
        protected string $contentSlot = "{{content}}",
        protected string $viewPath = VIEW_PATH,
        protected string $layoutPath = LAYOUT_PATH
    ) {
    }

    public static function make(
        string $view,
        array $data = [],
        string $layout = "default",
        string $contentSlot = "{{content}}",
        string $viewPath = VIEW_PATH,
        string $layoutPath = LAYOUT_PATH
    ) {
        return new static($view, $data, $layout, $contentSlot, $viewPath, $layoutPath);
    }

    public function render(): string
    {
        $layoutContent = $this->getLayout();
        $viewContent = $this->getView();
        return str_replace($this->contentSlot, $viewContent, $layoutContent);
    }

    protected function getView(): string
    {
        return $this->getContentFile($this->viewPath . $this->view . ".view.php");
    }

    protected function getLayout(): string
    {
        return $this->getContentFile($this->layoutPath . $this->layout . ".view.php");
    }

    protected function getContentFile(string $filePath): string
    {
        echo $filePath . PHP_EOL;
        foreach ($this->data as $key => $value) {
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

    public function __toString()
    {
        return $this->render();
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
}
