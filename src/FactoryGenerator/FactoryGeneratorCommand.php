<?php

namespace Myth\Generators\FactoryGenerator;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/3
 * Time: 5:44 PM
 */
class FactoryGeneratorCommand extends Command
{
    // https://laravel.com/docs/5.8/artisan
    protected $signature = 'make:factory 
        {model : model class name}
    ';

    protected $description = 'laravel-package make:factory Foo ,need database connection to run';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $steps = [
            FactoryGenerator::class,
        ];

        foreach ($steps as $step) {
            (new $step(array_merge($this->options(), $this->arguments())))->run();
        }

        $this->info($this->argument('model') . ' generated');
    }
}
