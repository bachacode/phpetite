<?php

namespace Petite\Tests\Container\MockClasses;

class MockClassTwo
{
    public function __construct(
        private MockClass $dependency
    ) {
    }
}
