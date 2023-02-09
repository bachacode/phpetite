<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude([
        'app',
        'public',
        'routes',
        'vendor'
    ])
    ->in(dirname(__DIR__) . '/../')
;

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@PSR12' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
;