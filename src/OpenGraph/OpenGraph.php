<?php

namespace Abdellahramadan\OpenGraphBundle\OpenGraph;

use Abdellahramadan\OpenGraphBundle\OpenGraph\OpenGraphInterface;

class OpenGraph implements OpenGraphInterface
{
    private string $title='';
    private string $description='';
    private string $imageUrl='';
    private string $url='';
    private string $type='';

    private array $structuredProperty = [
        'type' => null,
        'property' => null,
        'content' => null,
    ];
    private array $structuredProperties = [];


    public function setTitle(string $title): OpenGraphInterface
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): OpenGraphInterface
    {
        $this->description = $description;
        return $this;
    }

    public function setImage(string $image): OpenGraphInterface
    {
        $this->imageUrl = $image;
        return $this;
    }

    public function getImage(): string
    {
        return $this->imageUrl;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): OpenGraphInterface
    {
        $this->url = $url;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getStructuredProperties(): array
    {
        return $this->structuredProperties;
    }

    public function addStructuredProperty(string $type, string $property, string $content): OpenGraphInterface
    {
        if (!in_array($type, ['video', 'audio', 'image'])) {
            return $this;
        }

        $this->structuredProperty['type'] = $type;
         $this->structuredProperty['property'] = $property;
         $this->structuredProperty['content'] = $content ;

        if (!isset($this->structuredProperty[$type])) {
            $this->structuredProperty[$type] = [];
        }

        $this->structuredProperties['property'][] = $this->structuredProperty;
        return $this;
    }
}