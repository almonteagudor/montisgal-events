<?php

namespace App\Entity;

use App\Repository\UserEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\SuperAdmin\Users\Domain\User as UserDomain;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserEntityRepository::class)]
#[ORM\Table(name: 'users')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USER_NAME', fields: ['userName'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class UserEntity implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Id]
    private ?Uuid $id = null;

    #[ORM\Column(length: 50)]
    private ?string $userName = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    private ?string $password = null;

    #[ORM\Column]
    private bool $verified = false;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $imageName = null;

    /** @var string[] */
    #[ORM\Column]
    private array $roles = [];

    /** @var Collection<int, EventGroup> */
    #[ORM\OneToMany(targetEntity: EventGroup::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $eventGroups;

    public function __construct()
    {
        $this->eventGroups = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): static
    {
        $this->verified = $verified;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): static
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function getRole(): string
    {
        if (in_array('ROLE_SUPER_ADMIN', $this->roles)) return 'ROLE_SUPER_ADMIN';
        if (in_array('ROLE_ADMIN', $this->roles)) return 'ROLE_ADMIN';

        return 'ROLE_USER';
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, EventGroup>
     */
    public function getEventGroups(): Collection
    {
        return $this->eventGroups;
    }

    public function addEventGroup(EventGroup $eventGroup): static
    {
        if (!$this->eventGroups->contains($eventGroup)) {
            $this->eventGroups->add($eventGroup);
            $eventGroup->setUser($this);
        }

        return $this;
    }

    public function removeEventGroup(EventGroup $eventGroup): static
    {
        if ($this->eventGroups->removeElement($eventGroup)) {
            if ($eventGroup->getUser() === $this) {
                $eventGroup->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function toUserDomain(): UserDomain
    {
        return UserDomain::user(
            $this->id->toString(),
            $this->userName,
            $this->email,
            $this->password,
            $this->verified,
            $this->imageName,
            $this->getRole(),
        );
    }

    private function isAdmin(): bool
    {
        return in_array('ROLE_ADMIN', $this->roles) || in_array('ROLE_SUPER_ADMIN', $this->roles);
    }

    private function isSuperAdmin(): bool
    {
        return in_array('ROLE_SUPER_ADMIN', $this->roles);
    }
}
