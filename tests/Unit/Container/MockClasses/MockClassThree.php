<?php

namespace Petite\Unit\Container\MockClasses;

class MockClassThree
{
    public function __construct(
        private MockInterface $dependency
    ) {
    }
}
