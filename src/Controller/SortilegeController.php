<?php

namespace App\Controller;

use App\Entity\Sortilege;
use App\Form\SortilegeType;
use App\Repository\SortilegeRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sortilege')]
final class SortilegeController extends AbstractController
{
    #[Route(name: 'app_sortilege_index', methods: ['GET'])]
    public function index(SortilegeRepository $sortilegeRepository): Response
    {
        return $this->render('sortilege/index.html.twig', [
            'sortileges' => $sortilegeRepository->findByEleve(False),
        ]);
    }

    #[Route('/new', name: 'app_sortilege_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sortilege = new Sortilege();
        $form = $this->createForm(SortilegeType::class, $sortilege);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sortilege);
            $entityManager->flush();

            return $this->redirectToRoute('app_sortilege_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sortilege/new.html.twig', [
            'sortilege' => $sortilege,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sortilege_show', methods: ['GET'])]
    public function show(Sortilege $sortilege): Response
    {
        return $this->render('sortilege/show.html.twig', [
            'sortilege' => $sortilege,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sortilege_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sortilege $sortilege, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SortilegeType::class, $sortilege);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sortilege_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sortilege/edit.html.twig', [
            'sortilege' => $sortilege,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sortilege_delete', methods: ['POST'])]
    public function delete(Request $request, Sortilege $sortilege, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sortilege->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($sortilege);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sortilege_index', [], Response::HTTP_SEE_OTHER);
    }
}
