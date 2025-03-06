<?php

namespace Abdellahramadan\OpenGraphBundle\Twig\Extensions;

use Abdellahramadan\OpenGraphBundle\OpenGraph\OpenGraphInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class OpenGraphExtension extends AbstractExtension
{
    
    public function __construct(private readonly OpenGraphInterface $openGraph, private readonly ParameterBagInterface $parameterBag) {}
    public function getFunctions(): array
    {
        return [
            new TwigFunction('open_graph', [$this, 'getOpenGraph'], ['is_safe' => ['html']]),
        ];
    }
    
    public function getOpenGraph(): string
    {
        $openGraphString = '';
        $defaults = $this->parameterBag->get('open_graph');

        if (!empty($defaults)) {
            if ($this->openGraph->getTitle() === '' && array_key_exists('og_title', $defaults)) {
                $this->openGraph->setTitle($defaults['og_title']);
            }

            if ($this->openGraph->getDescription() === '' && array_key_exists('og_description', $defaults)) {
                $this->openGraph->setDescription($defaults['og_description']);
            }

            if ($this->openGraph->getSiteName() === '' && array_key_exists('og_sitename', $defaults)) {
                $this->openGraph->setSiteName($defaults['og_sitename']);
            }

            if ($this->openGraph->getUrl() === '' && array_key_exists('og_url', $defaults)) {
                $this->openGraph->setUrl($defaults['og_url']);
            }

            if ($this->openGraph->getType() === '' && array_key_exists('og_type', $defaults)) {
                $this->openGraph->setType($defaults['og_type']);
            }
        }
        
        if ($this->openGraph->getTitle() !== '') {
            $openGraphString .=  sprintf('<meta property="og:title" content="%s" />', strip_tags($this->openGraph->getTitle()));
        }

        if ($this->openGraph->getDescription() !== '') {
            $openGraphString .= sprintf('<meta property="og:description" content="%s" />', strip_tags($this->openGraph->getDescription()));
        }

        if ($this->openGraph->getImage() !== '') {
            $openGraphString .= sprintf('<meta property="og:image" content="%s" />', strip_tags($this->openGraph->getImage()));
        }

        if ($this->openGraph->getUrl() !== '') {
            $openGraphString .= sprintf('<meta property="og:url" content="%s" />', strip_tags($this->openGraph->getUrl()));
        }

        if ($this->openGraph->getType() !== '') {
            $openGraphString .= sprintf('<meta property="og:type" content="%s" />',  strip_tags($this->openGraph->getType()));
        }

        if ($this->openGraph->getSiteName()) {
            $openGraphString .= sprintf('<meta property="og:site_name" content="%s" />', $this->openGraph->getSiteName());
        }

        if ($this->openGraph->getStructuredProperties()) {
            foreach ($this->openGraph->getStructuredProperties() as $property => $value) {
                $openGraphString .= sprintf('<meta property="og:%s" content="%s" />', $value[0]['type'], $value[0]['content']);
                foreach ($value as $index => $structuredProperty) {
                    $openGraphString .= sprintf('<meta property="og:%s:%s" content="%s" />', $structuredProperty['type'], $structuredProperty['property'], $structuredProperty['content']);
                }
            }
        }

        if ($this->openGraph->getMusicProperties()) {
            $contents = $this->openGraph->getMusicProperties();

            foreach ($contents as $content) {
                $openGraphString .= sprintf('<meta property="music:%s" content="%s" />', $content['property'], $content['content']);
            }
        }

        if ($this->openGraph->getTwitterCardProperties()) {
            foreach ($this->openGraph->getTwitterCardProperties() as $name => $content) {
                $openGraphString .= sprintf('<meta property=twitter:"%s" content="%s" />', $name, $content);
            }
        }

        return $openGraphString;
    }
}