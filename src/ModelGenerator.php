<?php

namespace Myth\Generators;


/**
 * Class ModelGenerator
 * @package Prettus\Repository\Generators
 */
class ModelGenerator extends Generator
{

    protected $stub = 'model';


    public function getConfigClassPath()
    {
        $path = $this->config('generator.paths.models', 'Services');
        return $path;
    }

    protected function getRootNamespace()
    {
        return parent::getRootNamespace() . '\\' . $this->getConfigClassPath();
    }

    public function getPath()
    {
        return $this->makePath([
            $this->getBasePath(),
            'src',
            $this->getConfigClassPath(),
            $this->getName() . $this->suffix
        ]);
    }
}

