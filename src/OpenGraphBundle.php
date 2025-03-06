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

        if (isset($config['default_og'])) {
            $container->parameters()->set('open_graph', $config['default_og']);
        }
    }

    public function configure(DefinitionConfigurator $definition): void
    {
       $definition->rootNode()
            ->children()
                ->arrayNode('default_og')
                            ->children()
                                ->scalarNode('sitename')->info('Default og sitename')->end()
                                ->scalarNode('type')->info('Default og type')->end()
                                ->scalarNode('title')->info('Default og title')->end()
                                ->scalarNode('description')->info('Default og description')->end()
                                ->scalarNode('url')->info('Default og URL')->end()

                            ->end()
                ->end()
           ->end();
    }
}