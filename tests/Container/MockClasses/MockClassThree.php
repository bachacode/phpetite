<?php

namespace Petite\Tests\Container\MockClasses;

class MockClassThree
{
    public function __construct(
        private MockInterface $dependency
    ) {
    }
}
