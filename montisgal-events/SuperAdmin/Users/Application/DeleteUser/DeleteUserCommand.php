<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Application\DeleteUser;

final class DeleteUserCommand
{
    public function __construct(private $id) {}

    public function id()
    {
        return $this->id;
    }
}