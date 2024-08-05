<?php

declare(strict_types=1);

namespace App\Controller\SuperAdmin\Users;

use MontisgalEvents\Shared\Application\Exceptions\AccessDeniedException;
use MontisgalEvents\Shared\Domain\Exceptions\NotFoundException;
use MontisgalEvents\SuperAdmin\Users\Application\DeleteUser\DeleteUserCommand;
use MontisgalEvents\SuperAdmin\Users\Application\DeleteUser\DeleteUserCommandHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/users')]
class DeleteUserController extends AbstractController
{
    #[Route('/{id}', name: 'super_admin_users_delete_user', methods: ['DELETE'])]
    public function execute(string $id, DeleteUserCommandHandler $handler): JsonResponse
    {
        $command = new DeleteUserCommand($id);

        try {
            $handler->execute($command);

            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        } catch (AccessDeniedException) {
            return new JsonResponse(null, Response::HTTP_FORBIDDEN);
        } catch (NotFoundException) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }
    }
}