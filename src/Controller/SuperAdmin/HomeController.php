<?php

namespace App\Controller\SuperAdmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'super_admin_home')]
    public function index(): Response
    {
        return $this->render('super_admin/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
