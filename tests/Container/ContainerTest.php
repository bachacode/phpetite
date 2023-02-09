<?php

declare(strict_types=1);

namespace Petite\Tests\Container;

use Petite\Container\Container;
use Petite\Container\ContainerException;
use PHPUnit\Framework\TestCase;
use Petite\Tests\Container\MockClasses\MockClass;
use Petite\Tests\Container\MockClasses\MockClassTwo;
use Petite\Tests\Container\MockClasses\MockClassThree;
use Petite\Tests\Container\MockClasses\MockClassFour;
use Petite\Tests\Container\MockClasses\MockClassFive;
use Petite\Tests\Container\MockClasses\MockInterface;

class ContainerTest extends TestCase
{
    public function testItReturnsFalseIfEntryExists(): void
    {
        $container = new Container();
        $result = $container->has(MockClass::class);
        $expected = false;
        $this->assertSame($expected, $result);
    }

    public function testItReturnsTrueIfEntryExists(): void
    {
        $container = new Container();
        $container->set(
            MockClass::class,
            fn () => new MockClass()
        );
        $result = $container->has(MockClass::class);
        $expected = true;
        $this->assertSame($expected, $result);
    }

    public function testItAutoWiresDependency(): void
    {
        $container = new Container();
        $resolvedClass = $container->resolve(MockClassTwo::class);
        $expected = new MockClassTwo(new MockClass());
        $this->assertEquals($expected, $resolvedClass);
    }

    public function testItAutoWiresInterfaceDependency(): void
    {
        $container = new Container();
        $container->set(MockInterface::class, MockClass::class);
        $resolvedClass = $container->resolve(MockClassThree::class);
        $expected = new MockClassThree(new MockClass());
        $this->assertEquals($expected, $resolvedClass);
    }

    public function testItThrowsExceptionWhenDependencyIsNotNamedTyped(): void
    {
        $container = new Container();
        $this->expectException(ContainerException::class);
        $container->resolve(MockClassFour::class);
    }

    public function testItThrowsExceptionWhenDependencyIsNotTypeHinted(): void
    {
        $container = new Container();
        $this->expectException(ContainerException::class);
        $container->resolve(MockClassFive::class);
    }
}
