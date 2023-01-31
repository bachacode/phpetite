<?php

namespace Petite\Http;

use Psr\Http\Message\RequestInterface;

class Request 
{
    readonly array $uri;
    readonly string $method;
    readonly string $path;
    readonly array $params;

    public function __construct()
    {
        $this->uri = parse_url($_SERVER['REQUEST_URI']);
        $this->setPath($this->uri['path']);
        if(isset($this->uri['query'])){
        $this->setParams($this->uri['query']);
        }
        $this->setHttpMethod($_SERVER['REQUEST_METHOD']);
    }

    public function setPath(string $uri): void
    {
        if(strlen($uri) != 1){
        $uri = rtrim($uri, "/");
        }
        $this->path = $uri;
    }
    public function setParams(mixed $params)
    {
        $this->params = explode('&', $params);
        print_r($this->params);
    }
    
    public function setHttpMethod(string $method): void
    {
        $this->method = $method;
    }
}