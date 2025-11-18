<?php

namespace App\Command;

use App\Repository\EleveRepository;
use App\Repository\MaisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:choixpeau',
    description: 'Commande qui permet de placer un élève dans une maison',
)]
class ChoixpeauCommand extends Command
{
    private $eleveRepository;
    private $maisonRepository;
    private $entityManager;

    public function __construct(EleveRepository $eleveRepository, MaisonRepository $maisonRepository,EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->eleveRepository = $eleveRepository;
        $this->maisonRepository = $maisonRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('id-eleve', InputArgument::OPTIONAL, 'Id de l\'élève à classer')
            ->addOption('maison', "m", InputOption::VALUE_REQUIRED, 'Forcer la maison')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $idEleve = $input->getArgument('id-eleve');
        $eleve = $this->eleveRepository->find($idEleve);
        if ($eleve) {
            $io->note(sprintf('Je suis bien sur la tête de %s', $eleve->getNom()));
        }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        if($input->getOption("maison")){
            $maison = $this->maisonRepository->findOneBy(["nom"=> $input->getOption("maison")]);
        }
        else{
            $maisons = $this->maisonRepository->findAll();
            $maison = $maisons[array_rand($maisons)];
        }
        $io->note(sprintf('hmmmm difficile difficile... je dirai..'));
        $io->success($eleve->getNom()." ira à ".$maison->getNom());
        $eleve->setMaison($maison);
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
