<?php

declare(strict_types=1);

namespace Test\Unit;

use Petite\Routing\Controller;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function testItRendersViewFromController(): void
    {
        $controller = new Controller();
        $view = $controller->view(
            view: 'test',
            layout: 'testLayout',
            viewPath: dirname(__DIR__) .'\\View\\views\\',
            layoutPath: dirname(__DIR__) . '\\View\\views\\layouts\\'
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