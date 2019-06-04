<?php

namespace Myth\Generators;


/**
 * Class ModelGenerator
 * @package Prettus\Repository\Generators
 */
class ReadmeGenerator extends Generator
{

    protected $stub = 'README';

    protected $suffix = '.md';

    public function getPath()
    {
        return $this->getBasePath() . '/' . $this->stub . $this->suffix;
    }
}

