<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Application\CreateUser;

use MontisgalEvents\Shared\Application\Exceptions\AccessDeniedException;
use MontisgalEvents\Shared\Application\Services\HasherServiceInterface;
use MontisgalEvents\Shared\Application\Services\SecurityServiceInterface;
use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\SuperAdmin\Users\Domain\User;
use MontisgalEvents\SuperAdmin\Users\Domain\UserRepositoryInterface;

readonly final class CreateUserCommandHandler
{
    public function __construct(
        private SecurityServiceInterface $securityService,
        private HasherServiceInterface $hasherService,
        private UserRepositoryInterface $userRepository,
    ) {}

    /**
     * @throws AccessDeniedException
     * @throws ValidationException
     */
    public function execute(CreateUserCommand $command): User
    {
        $this->securityService->superAdminAccess();

        $password = $this->hasherService->hash($command->password());

        $user = User::newUser(
            $command->userName(),
            $command->email(),
            $password,
            false,
            null,
            $command->rol(),
        );

        $this->userRepository->insertUser($user);

        return $user;
    }
}