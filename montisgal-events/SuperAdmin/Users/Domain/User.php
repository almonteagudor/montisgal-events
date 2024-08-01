<?php

declare(strict_types=1);

namespace MontisgalEvents\SuperAdmin\Users\Domain;

use MontisgalEvents\Shared\Domain\Exceptions\ValidationException;
use MontisgalEvents\Shared\Domain\ValueObjects\Id;
use MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects\Email;
use MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects\HashedPassword;
use MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects\ImageName;
use MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects\Rol;
use MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects\UserName;
use MontisgalEvents\SuperAdmin\Users\Domain\ValueObjects\Verified;

class User
{
    public const ENTITY_NAME = 'User';

    /**
     * @throws ValidationException
     */
    public static function user(
        string $id,
        string $userName,
        string $email,
        string $password,
        bool $verified,
        ?string $imageName,
        string $rol,
    ): self
    {
        return self::fromValues($id, $userName, $email, $password, $verified, $imageName, $rol);
    }

    /**
     * @throws ValidationException
     */
    public static function newUser(
        string $userName,
        string $email,
        string $password,
        bool $verified,
        ?string $imageName,
        string $rol,
    ): self
    {
        return self::fromValues(null, $userName, $email, $password, $verified, $imageName, $rol);
    }

    public function id(): string
    {
        return $this->id->getValue();
    }

    public function userName(): string
    {
        return $this->userName->value();
    }

    /**
     * @throws ValidationException
     */
    public function setUserName(string $userName): void
    {
        $this->userName = UserName::fromValue($userName);
    }

    public function email(): string
    {
        return $this->email->value();
    }

    /**
     * @throws ValidationException
     */
    public function setEmail(string $email): void
    {
        $this->email = Email::fromValue($email);
    }

    public function password(): string
    {
        return $this->password->value();
    }

    /**
     * @throws ValidationException
     */
    public function setPassword(string $password): void
    {
        $this->password = HashedPassword::fromValue($password);
    }

    public function isVerified(): bool
    {
        return $this->verified->value();
    }

    public function setVerified(): void
    {
        $this->verified = Verified::verified();
    }

    public function setNotVerified(): void
    {
        $this->verified = Verified::notVerified();
    }

    public function imageName(): ?string
    {
        return $this->imageName?->value();
    }

    /**
     * @throws ValidationException
     */
    public function setImageName(?string $imageName): void
    {
        if ($imageName) {
            $this->imageName = ImageName::fromValue($imageName);
        } else {
            $this->imageName = null;
        }
    }

    public function isAdmin(): bool
    {
        return $this->rol->isAdmin();
    }

    public function isSuperAdmin(): bool
    {
        return $this->rol->isSuperAdmin();
    }

    public function setRoleUser(): void
    {
        $this->rol = Rol::user();
    }

    public function setRoleAdmin(): void
    {
        $this->rol = Rol::admin();
    }

    public function setRoleSuperAdmin(): void
    {
        $this->rol = Rol::superAdmin();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->getValue(),
            'userName' => $this->userName->value(),
            'email' => $this->email->value(),
            'verified' => $this->verified->value(),
            'imageName' => $this->imageName?->value(),
            'rol' => $this->rol->value(),
        ];
    }

    private function __construct(
        private readonly Id $id,
        private UserName $userName,
        private Email $email,
        private HashedPassword $password,
        private Verified $verified,
        private ?ImageName $imageName,
        private Rol $rol,
    ) {}

    /**
     * @throws ValidationException
     */
    private static function fromValues(
        ?string $id,
        string $userName,
        string $email,
        string $password,
        bool $verified,
        ?string $imageName,
        string $rol,
    ): self
    {
        $validationException = ValidationException::empty();

        try {
            $id = $id ? Id::fromValue($id) : Id::random();

        } catch (ValidationException $e) {
            $validationException->addErrors($e->getErrors());
        }

        try {
            $userName = UserName::fromValue($userName);
        } catch (ValidationException $e) {
            $validationException->addErrors($e->getErrors());
        }

        try {
            $email = Email::fromValue($email);
        } catch (ValidationException $e) {
            $validationException->addErrors($e->getErrors());
        }

        try {
            $password = HashedPassword::fromValue($password);
        } catch (ValidationException $e) {
            $validationException->addErrors($e->getErrors());
        }

        try {
            if ($imageName) {
                $imageName = ImageName::fromValue($imageName);
            } else {
                $imageName = null;
            }
        } catch (ValidationException $e) {
            $validationException->addErrors($e->getErrors());
        }

        try {
            $rol = Rol::fromValue($rol);
        } catch (ValidationException $e) {
            $validationException->addErrors($e->getErrors());
        }

        if ($validationException->hasErrors()) {
            throw $validationException;
        }

        return new self(
            $id,
            $userName,
            $email,
            $password,
            $verified ? Verified::verified() : Verified::notVerified(),
            $imageName,
            $rol,
        );
    }
}