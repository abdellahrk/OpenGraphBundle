<?php

namespace Abdellahramadan\OpenGraphBundle\OpenGraph;

interface OpenGraphInterface
{
    public function setTitle(string $title): static;
    public function getTitle(): string;

    public function getDescription(): string;
    public function setDescription(string $description): static;

    public function setImage(string $image): self;
    public function getImage(): string;
    public function setUrl(string $url): self;
    public function getUrl(): string;
    public function setType(string $type): self;
    public function getType(): string;
    public function addStructuredProperty(string $type, string $property, string $content): self;
    public function getStructuredProperties(): array;
    public function setSiteName(string $siteName): self;
    public function getSiteName(): string;
    public function setLocale(string $locale): self;
    public function getLocale(): string;
    public function setAlternateLocale(string $alternateLocale): self;
    public function getAlternateLocale(): string;

    public function addMusicProperty(string $property, string $content): self;
    public function getMusicProperties(): array;

    public function addTwitterCardProperty(string $name, string $content): self;

    public function getTwitterCardProperties(): array;
}