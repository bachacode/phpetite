<?php

declare(strict_types=1);

namespace Petite\Tests\Routing;

use Petite\Routing\Controller;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function testItRendersViewFromController(): void
    {
        $controller = new Controller(
            __DIR__ . '/../View/views/',
            __DIR__ . '/../View/views/layouts/'
        );
        $view = $controller->view(
            file: 'test',
            layout: 'testLayout',
        );
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
}
