<?php

namespace App\Controller\SuperAdmin;

use MontisgalEvents\Shared\Application\Exceptions\AccessDeniedException;
use MontisgalEvents\Shared\Domain\Exceptions\NotFoundException;
use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\SuperAdmin\Users\Application\CreateUser\CreateUserCommand;
use MontisgalEvents\SuperAdmin\Users\Application\CreateUser\CreateUserCommandHandler;
use MontisgalEvents\SuperAdmin\Users\Application\DeleteUser\DeleteUserCommand;
use MontisgalEvents\SuperAdmin\Users\Application\DeleteUser\DeleteUserCommandHandler;
use MontisgalEvents\SuperAdmin\Users\Application\GetUsers\GetUsersQuery;
use MontisgalEvents\SuperAdmin\Users\Application\GetUsers\GetUsersQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/users')]
class UserController extends AbstractController
{
    #[Route('', name: 'super_admin_user_index', methods: ['GET'])]
    public function index(GetUsersQueryHandler $handler): JsonResponse
    {
        try {
            $users = $handler->execute(new GetUsersQuery());

            return new JsonResponse($users->toArray());
        } catch (AccessDeniedException $e) {
            return new JsonResponse(null, Response::HTTP_FORBIDDEN);
        }

    }

    #[Route('', name: 'super_admin_user_new', methods: ['POST'])]
    public function newUser(Request $request, CreateUserCommandHandler $handler): JsonResponse
    {
        $command = new CreateUserCommand(
            $request->getPayload()->get('userName'),
            $request->getPayload()->get('email'),
            $request->getPayload()->get('password'),
            null,
            $request->getPayload()->get('rol'),
        );

        try {
            $user = $handler->execute($command);
        } catch (AccessDeniedException $e) {
            return new JsonResponse(null, Response::HTTP_FORBIDDEN);
        } catch (ValidationException $e) {
            return new JsonResponse($e->toArray(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($user->toArray());
    }

    #[Route('/{id}', name: 'super_admin_user_show', methods: ['DELETE'])]
    public function deleteUser(string $id, DeleteUserCommandHandler $handler): JsonResponse
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
