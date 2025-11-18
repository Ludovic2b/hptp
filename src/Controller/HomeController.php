<?php

namespace App\Controller;

use App\Repository\EleveRepository;
use App\Repository\MaisonRepository;
use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EleveRepository $eleveRepository,ProfesseurRepository $professeurRepository,MaisonRepository $maisonRepository): Response
    {
        $maisons = $maisonRepository->getMaisonsClassementParPoints();
        $eleves =$eleveRepository->findAll();
        $professeurs =$professeurRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'nb_eleves' => count($eleves),
            'nb_profs' => count($professeurs),
            'maisons' => $maisons
        ]);
    }

    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('lucas@example.com')
            ->to('utrera.ludovic@orange.fr')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<a href="https://127.0.0.1:8000/">Voir mon site</a>');

        $mailer->send($email);

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
