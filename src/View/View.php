<?php

namespace Petite\View;

use Petite\View\ViewNotFoundException;

class View
{
    public function __construct(
        protected string $view,
        protected array $data = []
    ){
    }

    static public function make(string $view, array $data = [])
    {
        return new static($view, $data);
    }

    public function render(): string
    {
        ob_start();
        $viewPath = VIEW_PATH . $this->view . '.view.php';
        if (!file_exists($viewPath)){
            throw new ViewNotFoundException();
        }

        foreach ($this->data as $key => $value) {
            $$key = $value;
        }

        include VIEW_PATH.$this->view.'.view.php';
        return ob_get_clean();
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