<?php

namespace Petite\Tests\Container\MockClasses;

class MockClassFour
{
    public function __construct(
        private string $dependency
    ) {
    }
}
