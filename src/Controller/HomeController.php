<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'user_home')]
    public function index(): Response
    {
        if($this->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->redirectToRoute('super_admin_home');
        }

        if($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('user/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
