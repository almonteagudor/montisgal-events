<?php

namespace MontisgalEvents\Shared\Domain;

readonly final class ValidationError
{
    public static function create(string $entityName, string $propertyName, string $message): self
    {
        return new self($entityName, $propertyName, $message);
    }

    public function getEntityName(): string
    {
        return $this->entityName;
    }

    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    private function __construct(private string $entityName, private string $propertyName, private string $message) {}
}