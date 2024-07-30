<?php

namespace App\Service;

use App\Entity\UserEntity;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly final class UserService
{
    public function __construct(
        private SluggerInterface $slugger,
        private UserPasswordHasherInterface $userPasswordHasher,
        private ValidatorInterface $validator
    ) {
    }

    public function createUser(
        string $userName,
        string $email,
        string $plainPassword,
        bool $verified = false,
        ?string $imageName = null
    ): UserEntity | ConstraintViolationListInterface {
        $user = new UserEntity();

        $user->setUsername($userName);
        $user->setSlug($this->slugger->slug($userName));
        $user->setEmail($email);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $plainPassword));
        $user->setVerified($verified);
        $user->setImageName($imageName);

        $errors = $this->validator->validate($user);

        if($errors->count() > 0) {
            return $errors;
        }

        return $user;
    }
}