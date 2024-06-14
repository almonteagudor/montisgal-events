<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MediaController extends AbstractController
{
    #[Route('/uploads/images/{name}', name: 'app_media')]
    public function getUploadedImage(string $name, #[Autowire('%images_dir%')] string $imagesDir): Response
    {
        $file = new File("$imagesDir/$name");

        return $this->file($file);
    }
}
