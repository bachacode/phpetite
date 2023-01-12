<?php

namespace Petite;

class Testing
{
    public static function dd($value)
    {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";

        die();
    }

    public static function actualUri($value)
    {
        return $_SERVER['REQUEST_URI'] === $value;
    }
}