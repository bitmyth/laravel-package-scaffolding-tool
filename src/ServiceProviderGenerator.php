<?php

namespace Myth\Generators;


/**
 * Class ModelGenerator
 * @package Prettus\Repository\Generators
 */
class ServiceProviderGenerator extends Generator
{

    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'serviceProvider';

    public function getConfigClassPath()
    {
        $path = $this->config('generator.paths.providers', 'Providers');
        return $path;
    }

    protected function setUp()
    {
    }

    protected function getRootNamespace()
    {
        return parent::getRootNamespace() . '\Providers';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->makePath([
            $this->getBasePath(),
            'src',
            $this->getConfigClassPath(),
            $this->getName() . 'ServiceProvider' . $this->suffix,
        ]);
    }
}

