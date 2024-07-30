<?php

declare(strict_types=1);

namespace App\Service;

use MontisgalEvents\Shared\Application\Exceptions\AccessDeniedException;
use MontisgalEvents\Shared\Application\Services\SecurityServiceInterface;
use Symfony\Bundle\SecurityBundle\Security as SymfonySecurity;

readonly final class SecurityService implements SecurityServiceInterface
{
    public function __construct(private SymfonySecurity $security) {}

    /**
     * @inheritDoc
     */
    public function userAccess(): void
    {
        if (!$this->security->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }
    }

    /**
     * @inheritDoc
     */
    public function adminAccess(): void
    {
        if (!$this->security->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }
    }

    /**
     * @inheritDoc
     */
    public function superAdminAccess(): void
    {
        if (!$this->security->isGranted('ROLE_SUPER_ADMIN')) {
            throw new AccessDeniedException();
        }
    }
}