<?php

namespace Petite\Routing;

#[\Attribute]
class Route
{
    public function __construct(
        public string $uri,
        public string $method = 'GET'
    )
    {
        //...
    }
}