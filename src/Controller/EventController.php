<?php

namespace App\Controller;

use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/event/{id}', name: 'app_event_index', methods: ['GET'])]
    public function index(Event $event): Response
    {
        return $this->render('event/index.html.twig', [
            'event_name' => $event->getName(),
        ]);
    }
}
