<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManagerService
{
    const IMAGES_DIRECTORY = 'images';
    const USER_DIRECTORY = 'user';

    public function __construct(private readonly string $uploadsDir)
    {
    }

    function saveUserImage(UploadedFile $image): string
    {
        $filename = bin2hex(random_bytes(6)) . '.' . $image->guessExtension();
        $image->move(sprintf("%s/%s/%s", $this->uploadsDir, self::IMAGES_DIRECTORY, self::USER_DIRECTORY), $filename);

        return $filename;
    }

    function getUserImage(string $imageName): File
    {
        return new File(sprintf("%s/%s/%s/%s", $this->uploadsDir, self::IMAGES_DIRECTORY, self::USER_DIRECTORY, $imageName));
    }
}