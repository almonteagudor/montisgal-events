<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Application\CreateUser;

final readonly class CreateUserCommand
{
    public function __construct(
        private string $userName,
        private string $email,
        private string $password,
        private string $rol,
    ) {}

    public function userName(): string
    {
        return $this->userName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function rol(): string
    {
        return $this->rol;
    }
}