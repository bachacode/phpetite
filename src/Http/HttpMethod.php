<?php

namespace Petite\Http;

enum HttpMethod
{
    case GET;
    case POST;
    case PUT;
    case PATCH;
    case DELETE;

    public function value(): string
    {
        return match($this) 
        {
            HttpMethod::GET => 'GET',   
            HttpMethod::POST => 'POST',   
            HttpMethod::PUT => 'PUT',
            HttpMethod::PATCH => 'PATCH',
            HttpMethod::DELETE => 'DELETE'   
        };
    }
}