<?php

namespace App\Command;

use App\Entity\Sortilege;
use App\Repository\SortilegeRepository;
use App\Service\HarryPotterApi;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:api:get:spell',
    description: 'Récupère les sortilèges depuis l\'API Harry Potter',
)]
class ApiGetSpellCommand extends Command
{
    private HarryPotterApi $hpapi;
    private SortilegeRepository $sortilegeRepository;
    private EntityManagerInterface $entityManager;
    public function __construct(HarryPotterApi $hpapi,EntityManagerInterface $entityManager,SortilegeRepository $sortilegeRepository)
    {
        $this->hpapi = $hpapi;
        $this->entityManager = $entityManager;
        $this->sortilegeRepository = $sortilegeRepository;
        parent::__construct();
    }

    protected function configure(): void
    {
        // $this
        //     ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
        //     ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        // ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        //$arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        $response = $this->hpapi->getSpellFromApi();

        if($response){
             $io->success('Données sortilèges bien récupérés depuis l\'API : ');
        }
        else{
            $io->error("Problème récupération depuis l'API");
        }
        
        return Command::SUCCESS;
    }
}
