<?php

namespace App\Controller;

use App\Entity\EventGroup;
use App\Form\EventGroupType;
use App\Repository\GroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/groups')]
class EventGroupController extends AbstractController
{
    #[Route('/', name: 'app_event_group_index', methods: ['GET'])]
    public function index(GroupRepository $groupRepository): Response
    {
        return $this->render('event_group/index.html.twig', [
            'event_groups' => $groupRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_event_group_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $eventGroup = new EventGroup();
        $form = $this->createForm(EventGroupType::class, $eventGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($eventGroup);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event_group/new.html.twig', [
            'event_group' => $eventGroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_group_show', methods: ['GET'])]
    public function show(EventGroup $eventGroup): Response
    {
        return $this->render('event_group/show.html.twig', [
            'event_group' => $eventGroup,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_event_group_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EventGroup $eventGroup, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventGroupType::class, $eventGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_event_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event_group/edit.html.twig', [
            'event_group' => $eventGroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_group_delete', methods: ['POST'])]
    public function delete(Request $request, EventGroup $eventGroup, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventGroup->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($eventGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_event_group_index', [], Response::HTTP_SEE_OTHER);
    }
}
