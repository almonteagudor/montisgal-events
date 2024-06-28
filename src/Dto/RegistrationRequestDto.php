<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegistrationRequestDto
{
    #[Assert\Length(min: 3, max: 50)]
    #[Assert\NotBlank]
    private ?string $userName = null;

    #[Assert\Email]
    #[Assert\Length(max: 150)]
    private ?string $email = null;

    #[Assert\IsTrue]
    private bool $agreeTerms = false;

    #[Assert\Length(min: 6, max: 50)]
    #[Assert\NotBlank]
    private ?string $plainPassword = null;

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function isAgreeTerms(): bool
    {
        return $this->agreeTerms;
    }

    public function setAgreeTerms(bool $agreeTerms): void
    {
        $this->agreeTerms = $agreeTerms;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }
}