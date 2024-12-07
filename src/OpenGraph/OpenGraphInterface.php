<?php

namespace Abdellahramadan\OpenGraphBundle\OpenGraph;

interface OpenGraphInterface
{
    public function setTitle(string $title): self;
    public function getTitle(): string;

    public function getDescription(): string;
    public function setDescription(string $description): self;

    public function setImage(string $image): self;
    public function getImage(): string;
    public function setUrl(string $url): self;
    public function getUrl(): string;
    public function setType(string $type): self;
    public function getType(): string;
    public function addStructuredProperty(string $type, string $property, string $content): self;
    public function getStructuredProperties(): array;
}