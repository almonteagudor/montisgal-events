<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects;

use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\SuperAdmin\Users\Domain\User;

readonly final class Rol
{
    private const PROPERTY_NAME = 'rol';

    private const ROLE_USER = 'ROLE_USER';
    private const ROLE_ADMIN = 'ROLE_ADMIN';
    private const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    public static function user(): self
    {
        return new self(self::ROLE_USER);
    }

    public static function admin(): self
    {
        return new self(self::ROLE_ADMIN);
    }

    public static function superAdmin(): self
    {
        return new self(self::ROLE_SUPER_ADMIN);
    }

    /**
     * @throws ValidationException
     */
    public static function fromValue($value): self
    {
        if(!is_string($value)) {
            throw ValidationException::create(User::ENTITY_NAME, self::PROPERTY_NAME, 'String required');
        }

        return match ($value) {
            self::ROLE_USER => new self(self::ROLE_USER),
            self::ROLE_ADMIN => new self(self::ROLE_ADMIN),
            self::ROLE_SUPER_ADMIN => new self(self::ROLE_SUPER_ADMIN),
            default => throw ValidationException::create(User::ENTITY_NAME, self::PROPERTY_NAME, 'Invalid rol value'),
        };
    }

    public function value(): string
    {
        return $this->value;
    }

    public function isAdmin(): bool
    {
        return $this->value === self::ROLE_ADMIN || $this->value === self::ROLE_SUPER_ADMIN;
    }

    public function isSuperAdmin(): bool
    {
        return $this->value === self::ROLE_SUPER_ADMIN;
    }

    private function __construct(private string $value) {}
}