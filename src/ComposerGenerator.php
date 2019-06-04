<?php

namespace Myth\Generators;


/**
 * Class ModelGenerator
 * @package Prettus\Repository\Generators
 */
class ComposerGenerator extends Generator
{

    protected $stub = 'composer';
    protected $suffix = '.json';

    public function getPath()
    {
        return $this->makePath([
            $this->getBasePath(),
            $this->stub . $this->suffix,
        ]);
    }
}

