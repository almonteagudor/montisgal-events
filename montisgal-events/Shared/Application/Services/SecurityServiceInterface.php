<?php

namespace MontisgalEvents\Shared\Application\Services;

use MontisgalEvents\Shared\Application\Exceptions\AccessDeniedException;

interface SecurityServiceInterface
{
    /**
     * @throws AccessDeniedException
     */
    public function userAccess(): void;

    /**
     * @throws AccessDeniedException
     */
    public function adminAccess(): void;


    /**
     * @throws AccessDeniedException
     */
    public function superAdminAccess(): void;
}