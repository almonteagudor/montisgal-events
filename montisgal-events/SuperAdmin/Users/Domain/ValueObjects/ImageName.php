<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects;

use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\SuperAdmin\Users\Domain\User;

readonly final class ImageName
{
    private const PROPERTY_NAME = 'imageName';
    private const MAX_LENGTH = 50;

    /**
     * @throws ValidationException
     */
    public static function fromValue($value): self
    {
        self::validate($value);

        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    private function __construct(private string $value) {}

    /**
     * @throws ValidationException
     */
    private static function validate($value): void
    {
        if(!is_string($value)) {
            throw ValidationException::create(User::ENTITY_NAME, self::PROPERTY_NAME, 'String required');
        }

        if (strlen($value) > self::MAX_LENGTH) {
            throw ValidationException::create(User::ENTITY_NAME, self::PROPERTY_NAME, 'Maximum length is ' . self::MAX_LENGTH);
        }
    }
}