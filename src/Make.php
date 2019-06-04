<?php

namespace Myth\Generators;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/3
 * Time: 5:44 PM
 */
class Make extends Command
{
    // https://laravel.com/docs/5.8/artisan
    protected $signature = 'make:package 
        {name : package name}
        {--force=true}

    ';

    protected $description = 'laravel-package make:package Foo';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $steps = [
            ServiceProviderGenerator::class,
            ModelGenerator::class,
            ReadmeGenerator::class,
            ConfigGenerator::class,
            ComposerGenerator::class
        ];

        foreach ($steps as $step) {
            (new $step(array_merge($this->options(), $this->arguments())))->run();
        }

        $this->info($this->argument('name') . ' generated');
    }
}
