<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('tools')
    ->exclude('node_modules')
    ->exclude('vendor')
    ->exclude('var')
    ->in(__DIR__)
;

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR12' => true,
    '@PSR1' => true,
    'array_syntax' => ['syntax' => 'short'],
])
    ->setFinder($finder)
;