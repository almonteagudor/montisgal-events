<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects;

use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\SuperAdmin\Users\Domain\User;

readonly final class HashedPassword
{
    private const PROPERTY_NAME = 'password';
    private const MAX_LENGTH = 100;

    /**
     * @throws ValidationException
     */
    public static function fromValue(string $value): self
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
    private static function validate(string $value): void
    {
        if (strlen($value) > self::MAX_LENGTH) {
            throw ValidationException::create(User::ENTITY_NAME, self::PROPERTY_NAME, 'Maximum length is ' . self::MAX_LENGTH);
        }
    }
}