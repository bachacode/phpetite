<?php

namespace Petite\Unit\Container\MockClasses;

class MockClassTwo
{
    public function __construct(
        private MockClass $dependency
    ) {
    }
}
