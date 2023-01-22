<?php

namespace Petite\Routing;

use Attribute;

#[Attribute]
class Route
{

    public function __construct(public string $uri, public string $method = 'GET')
    {
        
    }
}