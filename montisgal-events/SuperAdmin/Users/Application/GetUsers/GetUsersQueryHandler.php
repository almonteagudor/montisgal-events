<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Application\GetUsers;

use MontisgalEvents\Shared\Application\Exceptions\AccessDeniedException;
use MontisgalEvents\Shared\Application\Services\SecurityServiceInterface;
use MontisgalEvents\SuperAdmin\Users\Domain\UserCollection;
use MontisgalEvents\SuperAdmin\Users\Domain\UserRepositoryInterface;

readonly final class GetUsersQueryHandler
{
    public function __construct(private SecurityServiceInterface $security, private UserRepositoryInterface $userRepository) {}

    /**
     * @throws AccessDeniedException
     */
    public function execute(GetUsersQuery $query): UserCollection {
        $this->security->superAdminAccess();

        return $this->userRepository->getUsers();
    }
}