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
        $container->parameters()->set('open_graph', $config['defaults']);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
       $definition->rootNode()
            ->children()
                ->arrayNode('defaults')
                    ->children()
                        ->scalarNode('og_sitename')->info('Default og sitename')->end()
                        ->scalarNode('og_type')->info('Default og type')->end()
                        ->scalarNode('og_title')->info('Default og title')->end()
                        ->scalarNode('og_description')->info('Default og description')->end()
                        ->scalarNode('og_url')->info('Default og URL')->end()
                    ->end()
                ->end()
           ->end();
    }
}