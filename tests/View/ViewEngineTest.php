<?php

declare(strict_types=1);

namespace Petite\Tests\View;

use Petite\View\View;
use Petite\View\ViewEngine;
use Petite\View\ViewNotFoundException;
use PHPUnit\Framework\TestCase;

class ViewEngineTest extends TestCase
{
    private ViewEngine $viewEngine;

    protected function setUp(): void
    {
        $this->viewEngine = new ViewEngine(
            viewPath: __DIR__ . '/views/',
            layoutPath: __DIR__ . '/views/layouts/'
        );
    }
    public function testItRendersViewWithoutParams(): void
    {
        $view = new View(
            file: 'test',
            layout: 'testLayout',
        );
        $content = $this->viewEngine->render($view);
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
            preg_replace("/\s*/", "", $content),
        );
    }

    public function testItRendersViewWithParams(): void
    {
        $params = [
            'first' => 'Hello',
            'second' => 'World'
        ];
        $view = new View(
            file: 'testParams',
            data: $params,
            layout: 'testLayout',
        );
        $content = $this->viewEngine->render($view);
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
            preg_replace("/\s*/", "", $content),
        );
    }

    public function testItThrowsViewNotFoundException(): void
    {
        $this->expectException(ViewNotFoundException::class);
        $view = new View(
            file: 'testFileNonExistant',
            layout: 'testLayout',
        );
        $content = $this->viewEngine->render($view);
    }
}
