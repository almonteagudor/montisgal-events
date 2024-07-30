<?php

declare(strict_types=1);

namespace MontisgalEvents\Shared\Domain\ValueObjects;

use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\SuperAdmin\Users\Domain\User;
use Symfony\Component\Uid\Uuid;

readonly final class Id
{
    private const PROPERTY_NAME = 'id';

    public static function random(): self
    {
        return new self(Uuid::v4());
    }

    /**
     * @throws ValidationException
     */
    public static function fromValue(string $value): self
    {
        if (!Uuid::isValid($value)) {
            throw ValidationException::create(User::ENTITY_NAME, self::PROPERTY_NAME, 'The value is not a valid uuid');
        }

        return new self(Uuid::fromString($value));
    }

    public function getValue(): string
    {
        return $this->value->toString();
    }

    private function __construct(private Uuid $value) {}
}
