<?php

declare(strict_types=1);

namespace App\Service;

use MontisgalEvents\Shared\Application\Services\SluggerServiceInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

readonly final class SluggerService implements SluggerServiceInterface
{
    public function __construct(private SluggerInterface $slugger) {}


    public function slug(string $value): string
    {
        return $this->slugger->slug(strtolower($value))->toString();
    }
}