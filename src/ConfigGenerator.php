<?php

namespace Myth\Generators;


/**
 * Class ModelGenerator
 * @package Prettus\Repository\Generators
 */
class ConfigGenerator extends Generator
{

    protected $stub = 'config';

    protected function getConfigClassPath()
    {
        return 'configs';
    }


    public function getPath()
    {
        return $this->makePath([
            $this->getBasePath(),
            'src',
            $this->getConfigClassPath(),
            strtolower($this->getName()) . $this->suffix
        ]);
    }

}

