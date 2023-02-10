<?php

namespace Petite\Routing;

use Petite\Http\HttpMethod;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Route
{
    public HttpMethod $method;

    public function __construct(
        public string $uri,
        string $method = 'GET'
    ) {

        $this->method = match(strtoupper($method)) {
            'GET' => HttpMethod::GET,
            'POST' => HttpMethod::POST,
            'PUT' => HttpMethod::PUT,
            'PATCH' => HttpMethod::PATCH,
            'DELETE' => HttpMethod::DELETE,
        };
    }

}
