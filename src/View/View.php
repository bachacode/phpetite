<?php

namespace Petite\View;

class View extends ViewEngine
{
    private function __construct(
        protected string $view,
        protected array $data = [],
        protected string $layout = '',
    )
    {
        
    }

    public static function make(
        string $view,
        array $data = [],
        string $layout = "default",
    ) {
        return new static($view, $data, $layout);
    }

    public function render(): string
    {
        $layoutContent = $this->getLayout($this->layout);
        $viewContent = $this->getView($this->view, $this->data);
        return str_replace($this->contentSlot, $viewContent, $layoutContent);
    }
    
    public function __toString()
    {
        return $this->render();
    }

    public function __get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }
}
