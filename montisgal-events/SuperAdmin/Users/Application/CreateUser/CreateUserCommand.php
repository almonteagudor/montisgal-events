<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Application\CreateUser;

final class CreateUserCommand
{
    public function __construct(
        private $userName,
        private $email,
        private $password,
        private $imageName,
        private $rol,
    ) {}

    public function userName()
    {
        return $this->userName;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function imageName()
    {
        return $this->imageName;
    }

    public function rol()
    {
        return $this->rol;
    }
}