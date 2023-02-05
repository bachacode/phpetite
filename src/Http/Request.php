<?php

namespace Petite\Http;

class Request
{
    readonly array $uri;
    readonly string $method;
    readonly string $path;
    readonly array $params;

    public function __construct(
        string $uri,
        string $method
    ) {
        $this->uri = parse_url($uri);
        $this->method = $method;
        $this->setPath($this->uri['path']);
        if (isset($this->uri['query'])) {
            $this->setParams($this->uri['query']);
        }
    }

    public function setPath(string $uri): void
    {
        if (strlen($uri) != 1) {
            $uri = rtrim($uri, "/");
        }
        $this->path = $uri;
    }
    public function setParams(mixed $params)
    {
        $this->params = explode('&', $params);
    }
}
