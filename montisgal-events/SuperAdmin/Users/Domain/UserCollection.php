<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Domain;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class UserCollection implements IteratorAggregate
{
    /** @var User[] */
    private array $users = [];

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->users);
    }

    public function add(User $user): void
    {
        $this->users[] = $user;
    }

    public function toArray(): array
    {
        $users = [];

        foreach ($this->users as $user) {
            $users[] = $user->toArray();
        }

        return $users;
    }
}
