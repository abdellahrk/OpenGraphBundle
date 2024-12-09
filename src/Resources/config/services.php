<?php

namespace Abdellahramadan\SchemaOrgBundle\Resources\config;

use Abdellahramadan\OpenGraphBundle\OpenGraph\OpenGraph;
use Abdellahramadan\OpenGraphBundle\OpenGraph\OpenGraphInterface;
use Abdellahramadan\OpenGraphBundle\Twig\Extensions\OpenGraphExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->set('open.graph.bundle', OpenGraph::class);
    $services->alias(OpenGraphInterface::class, 'open.graph.bundle');
    $services->set('open.graph.bundle.twig.extension', OpenGraphExtension::class)
        ->tag('twig.extension')
    ;
};