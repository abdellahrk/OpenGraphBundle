<?php

namespace Abdellahramadan\OpenGraphBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class OpenGraphBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.php');
    }

    public function configure(DefinitionConfigurator $definition): void
    {
       $definition->rootNode()
           ->children()
               ->scalarNode('og_title')->info('og_title')->end()
                ->scalarNode('og_description')->info('og_description')->end()
           ->end();
       ;

    }

}