<?php

namespace App\Controller;

use App\Service\HarryPotterApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PersonnageController extends AbstractController
{
    #[Route('/personnage', name: 'app_personnage')]
    public function index(HarryPotterApi $hapi): Response
    {

        $personnages = $hapi->getCharactersFromApi();
        return $this->render('personnage/index.html.twig', [
            'controller_name' => 'PersonnageController',
            'personnages' => $personnages
        ]);
    }
}
