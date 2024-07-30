<?php

namespace MontisgalEvents\SuperAdmin\Users\Domain;

use MontisgalEvents\Shared\Domain\Exceptions\NotFoundException;

interface UserRepositoryInterface
{
    /**
     * @throws NotFoundException
     */
    public function getUserById(string $id): User;

    public function getUsers(): UserCollection;

    public function insertUser(User $user): void;

    /**
     * @throws NotFoundException
     */
    public function deleteUserById(string $id): void;
}