<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects;

use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\SuperAdmin\Users\Domain\User;

readonly final class UserName
{
    private const PROPERTY_NAME = 'userName';

    private const MIN_LENGTH = 3;
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

        if (strlen($value) < self::MIN_LENGTH) {
            throw ValidationException::create(User::ENTITY_NAME, self::PROPERTY_NAME, 'Minimum length is ' . self::MIN_LENGTH);
        }

        if (strlen($value) > self::MAX_LENGTH) {
            throw ValidationException::create(User::ENTITY_NAME, self::PROPERTY_NAME, 'Maximum length is ' . self::MAX_LENGTH);
        }
    }
}