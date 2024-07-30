<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects;

readonly final class Verified
{
    public static function verified(): self
    {
        return new self(true);
    }

    public static function notVerified(): self
    {
        return new self(false);
    }

    public function value(): bool
    {
        return $this->value;
    }

    private function __construct(private bool $value) {}
}