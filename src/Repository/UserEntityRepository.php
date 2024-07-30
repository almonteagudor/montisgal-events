<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MontisgalEvents\Shared\Domain\Exceptions\NotFoundException;
use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\SuperAdmin\Users\Domain\User;
use MontisgalEvents\SuperAdmin\Users\Domain\UserCollection;
use MontisgalEvents\SuperAdmin\Users\Domain\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<UserEntity>
 */
class UserEntityRepository extends ServiceEntityRepository implements PasswordUpgraderInterface, UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEntity::class);
    }

    /**
     * @throws NotFoundException
     */
    public function getUserById(string $id): User
    {
        $useEntity = $this->find($id);

        if ($useEntity) {
            throw NotFoundException::create($id, User::ENTITY_NAME);
        }

        return $useEntity;
    }

    /**
     * @throws ValidationException
     */
    public function getUsers(): UserCollection
    {
        $users = new UserCollection();
        $userEntities = $this->findAll();

        foreach ($userEntities as $userEntity) {
            $users->add($userEntity->toUserDomain());
        }

        return $users;
    }

    public function insertUser(User $user): void
    {
        $userEntity = new UserEntity();

        $userEntity->setUsername($user->userName());
        $userEntity->setEmail($user->email());
        $userEntity->setPassword($user->password());
        $userEntity->setVerified($user->isVerified());
        $userEntity->setImageName($user->imageName());

        if ($user->isAdmin()) {
            $userEntity->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        }

        if ($user->isSuperAdmin()) {
            $userEntity->setRoles(['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN']);
        }

        $this->getEntityManager()->persist($userEntity);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws NotFoundException
     */
    public function deleteUserById(string $id): void
    {
        $userEntity = $this->find($id);

        if (!$userEntity) {
            throw NotFoundException::create($id, User::ENTITY_NAME);
        }

        $this->getEntityManager()->remove($userEntity);
        $this->getEntityManager()->flush();
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof UserEntity) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
