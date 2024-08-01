<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Application\DeleteUser;

final readonly class DeleteUserCommand
{
    public function __construct(private string $id) {}

    public function id(): string
    {
        return $this->id;
    }
}