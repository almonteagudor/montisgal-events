<?php

namespace MontisgalEvents\Shared\Application\Services;

interface SluggerServiceInterface
{
    public function slug(string $value): string;
}