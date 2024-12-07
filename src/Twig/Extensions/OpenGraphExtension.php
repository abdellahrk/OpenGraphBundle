<?php

namespace Abdellahramadan\OpenGraphBundle\Twig\Extensions;

use Abdellahramadan\OpenGraphBundle\OpenGraph\OpenGraphInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class OpenGraphExtension extends AbstractExtension
{
    
    public function __construct(private readonly OpenGraphInterface $openGraph) {}
    public function getFunctions(): array
    {
        return [
            new TwigFunction('open_graph', [$this, 'getOpenGraph'], ['is_safe' => ['html']]),
        ];
    }
    
    public function getOpenGraph(): string
    {
        $openGraphString = '';
        
        if ($this->openGraph->getTitle() !== '') {
            $openGraphString .= sprintf("<meta property=\"og:title\" content=\"%s\" />", strip_tags($this->openGraph->getTitle()));
        }

        if ($this->openGraph->getDescription() !== '') {
            $openGraphString .= sprintf("<meta property=\"og:description\" content=\"%s\" />", strip_tags($this->openGraph->getDescription()));
        }

        if ($this->openGraph->getImage() !== '') {
            $openGraphString .= sprintf("<meta property=\"og:image\" content=\"%s\" />", strip_tags($this->openGraph->getImage()));
        }

        if ($this->openGraph->getUrl() !== '') {
            $openGraphString .= sprintf("<meta property=\"og:url\" content=\"%s\" />", strip_tags($this->openGraph->getUrl()));
        }

        if ($this->openGraph->getType() !== '') {
            $openGraphString .= sprintf("<meta property=\"og:type\" content=\"%s\" />",  strip_tags($this->openGraph->getType()));
        }

        if ($this->openGraph->getStructuredProperties()) {
            foreach ($this->openGraph->getStructuredProperties() as $property => $value) {
                $openGraphString .= sprintf("<meta property=\"og:%s\" content=\"%s\" />", $value[0]['type'], $value[0]['content']);
                foreach ($value as $index => $structuredProperty) {
                    $openGraphString .= sprintf("<meta property=\"og:%s:%s\" content=\"%s\" />", $structuredProperty['type'], $structuredProperty['property'], $structuredProperty['content']);
                }
            }
        }

        return $openGraphString;
    }
}