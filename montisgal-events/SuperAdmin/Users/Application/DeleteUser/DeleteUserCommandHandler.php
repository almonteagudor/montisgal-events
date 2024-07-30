<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Application\DeleteUser;

use MontisgalEvents\Shared\Application\Exceptions\AccessDeniedException;
use MontisgalEvents\Shared\Application\Services\SecurityServiceInterface;
use MontisgalEvents\Shared\Domain\Exceptions\NotFoundException;
use MontisgalEvents\SuperAdmin\Users\Domain\UserRepositoryInterface;

readonly final class DeleteUserCommandHandler
{
    public function __construct(
        private SecurityServiceInterface $securityService,
        private UserRepositoryInterface $userRepository,
    ) {}

    /**
     * @throws AccessDeniedException
     * @throws NotFoundException
     */
    public function execute(DeleteUserCommand $command): void
    {
        $this->securityService->superAdminAccess();

        $this->userRepository->deleteUserById($command->id());
    }
}