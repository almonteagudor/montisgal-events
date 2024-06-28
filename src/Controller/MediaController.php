<?php

namespace App\Controller;

use App\Service\FileManagerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MediaController extends AbstractController
{
    #[Route('/uploads/images/user/{name}', name: 'app_media_user_image')]
    public function getUploadedUserImage(string $name, FileManagerService $fileManager): Response
    {
        $file = $fileManager->getUserImage($name);

        return $this->file($file);
    }
}
