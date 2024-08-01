<?php

declare(strict_types=1);

namespace App\Controller\SuperAdmin\Users;

use MontisgalEvents\Shared\Application\Exceptions\AccessDeniedException;
use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\SuperAdmin\Users\Application\CreateUser\CreateUserCommand;
use MontisgalEvents\SuperAdmin\Users\Application\CreateUser\CreateUserCommandHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewUserController extends AbstractController
{
    #[Route('', name: 'super_admin_users_new_user', methods: ['POST'])]
    public function execute(Request $request, CreateUserCommandHandler $handler): JsonResponse
    {
        $userName = $request->getPayload()->get('userName');
        $email = $request->getPayload()->get('email');
        $password = $request->getPayload()->get('password');
        $rol = $request->getPayload()->get('rol');

        if (!is_string($userName)) return new JsonResponse(['userName', 'string required'], Response::HTTP_BAD_REQUEST);
        if (!is_string($email)) return new JsonResponse(['email', 'string required'], Response::HTTP_BAD_REQUEST);
        if (!is_string($password)) return new JsonResponse(['password', 'string required'], Response::HTTP_BAD_REQUEST);
        if (!is_string($rol)) return new JsonResponse(['rol', 'string required'], Response::HTTP_BAD_REQUEST);

        $command = new CreateUserCommand($userName, $email, $password, $rol);

        try {
            $user = $handler->execute($command);

            return new JsonResponse($user->toArray());
        } catch (AccessDeniedException) {
            return new JsonResponse(null, Response::HTTP_FORBIDDEN);
        } catch (ValidationException $e) {
            return new JsonResponse($e->toArray(), Response::HTTP_BAD_REQUEST);
        }
    }
}