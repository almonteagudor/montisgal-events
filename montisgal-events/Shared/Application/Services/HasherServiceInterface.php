<?php

namespace MontisgalEvents\Shared\Application\Services;

interface HasherServiceInterface
{
    public function hash(string $value): string;
}