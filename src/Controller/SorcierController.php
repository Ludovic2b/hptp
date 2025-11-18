<?php

namespace App\Controller;

use App\Entity\Sorcier;
use App\Form\SorcierType;
use App\Repository\SorcierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sorcier')]
final class SorcierController extends AbstractController
{
    #[Route(name: 'app_sorcier_index', methods: ['GET'])]
    public function index(SorcierRepository $sorcierRepository): Response
    {
        return $this->render('sorcier/index.html.twig', [
            'sorciers' => $sorcierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sorcier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sorcier = new Sorcier();
        $form = $this->createForm(SorcierType::class, $sorcier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sorcier);
            $entityManager->flush();

            return $this->redirectToRoute('app_sorcier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sorcier/new.html.twig', [
            'sorcier' => $sorcier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sorcier_show', methods: ['GET'])]
    public function show(Sorcier $sorcier): Response
    {
        return $this->render('sorcier/show.html.twig', [
            'sorcier' => $sorcier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sorcier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sorcier $sorcier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SorcierType::class, $sorcier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sorcier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sorcier/edit.html.twig', [
            'sorcier' => $sorcier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sorcier_delete', methods: ['POST'])]
    public function delete(Request $request, Sorcier $sorcier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sorcier->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($sorcier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sorcier_index', [], Response::HTTP_SEE_OTHER);
    }
}
