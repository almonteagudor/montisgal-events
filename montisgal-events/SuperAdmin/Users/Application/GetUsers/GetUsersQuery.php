<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Application\GetUsers;

readonly final class GetUsersQuery
{
    public function __construct(private ?int $page = null, private ?int $limit = null) {}

    public function page(): ?int
    {
        return $this->page;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }
}