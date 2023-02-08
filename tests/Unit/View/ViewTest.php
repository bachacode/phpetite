<?php

declare(strict_types=1);

namespace Test\Unit;

use Petite\View\View;
use Petite\View\ViewNotFoundException;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testItRendersViewWithoutParams(): void
    {
        $view = (string) View::make(
            view: 'test',
            layout: 'testLayout',
            viewPath: __DIR__ . '/views/',
            layoutPath: __DIR__ . '/views/layouts/'
        );
        echo  __DIR__ . '\\views\\' . PHP_EOL;
        $expected = <<<viewWithoutParams
        <html>
        <head>
            <title>Document</title>
        </head>
        <body>
            <h1>Hello World</h1>
        </body>
        </html>
        viewWithoutParams;
        $this->assertEquals(
            preg_replace("/\s*/", "", $expected),
            preg_replace("/\s*/", "", $view),
        );
    }

    public function testItRendersViewWithParams(): void
    {
        $params = [
            'first' => 'Hello',
            'second' => 'World'
        ];
        $view = (string) View::make(
            view: 'testParams',
            data: $params,
            layout: 'testLayout',
            viewPath: __DIR__ . '/views/',
            layoutPath: __DIR__ . '/views/layouts/'
        );
        $expected = <<<viewWithParams
        <html>
        <head>
            <title>Document</title>
        </head>
        <body>
            <h1>Hello</h1>
            <h2>World</h2>
        </body>
        </html>
        viewWithParams;
        $this->assertEquals(
            preg_replace("/\s*/", "", $expected),
            preg_replace("/\s*/", "", $view),
        );
    }

    public function testItThrowsViewNotFoundException(): void
    {
        $this->expectException(ViewNotFoundException::class);
        $view = (string) View::make(
            view: 'testFileNonExistant',
            layout: 'testLayout',
            viewPath: __DIR__ . '\\views\\',
            layoutPath: __DIR__ . '\\views\\layouts\\'
        );
    }
}
