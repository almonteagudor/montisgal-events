<?php

namespace App\Entity;

use App\Repository\EventRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: 'events')]
class Event
{
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Id]
    private ?Uuid $id = null;

    #[Assert\Length(min: 3, max: 150)]
    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[Assert\Length(max: 1000)]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $confirmationNeeded = null;

    #[Assert\NotBlank]
    #[Assert\Type(DateTimeInterface::class)]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $startDate = null;

    #[Assert\Type(DateTimeInterface::class)]
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $endDate = null;

    #[Assert\NotBlank]
    #[Assert\Type(DateTimeInterface::class)]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $registrationOpeningDate = null;

    #[Assert\NotBlank]
    #[Assert\Type(DateTimeInterface::class)]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $registrationClosingDate = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column]
    private ?bool $publicLocation = null;

    #[ORM\ManyToOne]
    private ?Location $location = null;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?EventGroup $eventGroup = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isConfirmationNeeded(): ?bool
    {
        return $this->confirmationNeeded;
    }

    public function setConfirmationNeeded(bool $confirmationNeeded): static
    {
        $this->confirmationNeeded = $confirmationNeeded;

        return $this;
    }

    public function getStartDate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getRegistrationOpeningDate(): ?DateTimeInterface
    {
        return $this->registrationOpeningDate;
    }

    public function setRegistrationOpeningDate(DateTimeInterface $registrationOpeningDate): static
    {
        $this->registrationOpeningDate = $registrationOpeningDate;

        return $this;
    }

    public function getRegistrationClosingDate(): ?DateTimeInterface
    {
        return $this->registrationClosingDate;
    }

    public function setRegistrationClosingDate(DateTimeInterface $registrationClosingDate): static
    {
        $this->registrationClosingDate = $registrationClosingDate;

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

    public function isPublicLocation(): ?bool
    {
        return $this->publicLocation;
    }

    public function setPublicLocation(bool $publicLocation): static
    {
        $this->publicLocation = $publicLocation;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getEventGroup(): ?EventGroup
    {
        return $this->eventGroup;
    }

    public function setEventGroup(?EventGroup $eventGroup): static
    {
        $this->eventGroup = $eventGroup;

        return $this;
    }
}
