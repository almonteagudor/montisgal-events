<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\UserEntity;
use MontisgalEvents\Shared\Application\Services\HasherServiceInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

readonly final class HasherService implements HasherServiceInterface
{
    public function __construct(private PasswordHasherFactoryInterface $hasherFactory) {}

    public function hash(string $value): string
    {
        $passwordHasher = $this->hasherFactory->getPasswordHasher(UserEntity::class);

        return $passwordHasher->hash($value, null);
    }
}