<?php

namespace App\Controller;

use App\Entity\Maison;
use App\Form\MaisonType;
use App\Repository\HistoriquePointRepository;
use App\Repository\MaisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/maison')]
final class MaisonController extends AbstractController
{
    
    #[Route(name: 'app_maison_index', methods: ['GET'])]
    public function index(MaisonRepository $maisonRepository): Response
    {

        return $this->render('maison/index.html.twig', [
            'maisons' => $maisonRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_maison_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $maison = new Maison();
        $form = $this->createForm(MaisonType::class, $maison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($maison);
            $entityManager->flush();

            return $this->redirectToRoute('app_maison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('maison/new.html.twig', [
            'maison' => $maison,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_maison_show', methods: ['GET'])]
    public function show(Maison $maison,HistoriquePointRepository $historiquePointRepository): Response
    {
        $points = 0;
        foreach ($maison->getEleves() as $eleve ) {
            # code...
            $historiquePointsEleve = $historiquePointRepository->findBy(['eleve'=>$eleve]);
            foreach ($historiquePointsEleve as  $historiquePointEleve) {
                # code...
                $points += $historiquePointEleve->getNbPoint();
            }
        }

        return $this->render('maison/show.html.twig', [
            'maison' => $maison,
            'points' => $points
        ]);
    }

    #[Route('/{id}/edit', name: 'app_maison_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Maison $maison, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MaisonType::class, $maison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_maison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('maison/edit.html.twig', [
            'maison' => $maison,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_maison_delete', methods: ['POST'])]
    public function delete(Request $request, Maison $maison, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maison->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($maison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_maison_index', [], Response::HTTP_SEE_OTHER);
    }
}
