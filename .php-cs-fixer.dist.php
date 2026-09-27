<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__)
    ->depth(0)
    ->notName('index-1.1.*.php')
    ->notName('lg-github-1.1.1.php')
    ->notName('.php-cs-fixer*.php')
    ->name('index.php')
    ->name('lg-github-1.1.2.php');

$config = new Config();

return $config
    ->setRules([
        '@PSR12' => true,
        'statement_indentation' => false,
        'indentation_type' => false,
        'no_closing_tag' => false,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(false)
    ->setUsingCache(false);
