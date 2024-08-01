<?php

declare(strict_types=1);

namespace App\Controller\SuperAdmin\Users;

use MontisgalEvents\Shared\Application\Exceptions\AccessDeniedException;
use MontisgalEvents\SuperAdmin\Users\Application\GetUsers\GetUsersQuery;
use MontisgalEvents\SuperAdmin\Users\Application\GetUsers\GetUsersQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetUsersController extends AbstractController
{
    #[Route('', name: 'super_admin_users_get_users', methods: ['GET'])]
    public function execute(GetUsersQueryHandler $handler): JsonResponse
    {
        try {
            $users = $handler->execute(new GetUsersQuery());

            return new JsonResponse($users->toArray());
        } catch (AccessDeniedException) {
            return new JsonResponse(null, Response::HTTP_FORBIDDEN);
        }
    }
}