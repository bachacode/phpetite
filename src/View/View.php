<?php

namespace Petite\View;

use Petite\View\ViewNotFoundException;

class View
{
    public function __construct(
        protected string $view,
        protected array $params = [],
        protected string $layout = "default",
        protected string $contentSlot = "{{content}}"
    ) {
    }

    public static function make(string $view, array $params = [], string $layout = "default")
    {
        return new static($view, $params, $layout);
    }

    public function render(): string
    {
        $layoutContent = $this->getLayout();
        $viewContent = $this->getView();
        return str_replace($this->contentSlot, $viewContent, $layoutContent);
    }

    protected function getView(): string
    {
        return $this->getContentFile(VIEW_PATH . $this->view . ".view.php");
    }

    protected function getLayout(): string
    {
        return $this->getContentFile(LAYOUT_PATH . $this->layout . ".view.php");
    }

    protected function getContentFile(string $filePath): string
    {
        foreach ($this->params as $key => $value) {
            $$key = $value;
        }
        if (!file_exists($filePath)) {
            throw new ViewNotFoundException();
        }
        ob_start();

        include_once $filePath;

        return (string) ob_get_clean();
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
