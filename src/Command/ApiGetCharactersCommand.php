<?php

namespace App\Command;

use App\Service\HarryPotterApi;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:api:get:characters',
    description: 'Add a short description for your command',
)]
class ApiGetCharactersCommand extends Command
{   
    private HarryPotterApi $hapi;
    public function __construct(HarryPotterApi $hapi)
    {
        $this->hapi = $hapi;
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
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        $response = $this->hapi->getCharactersFromApi();

        foreach ($response as  $personnage) {
            $io->writeln($personnage["name"]." - ". $personnage["house"]);
        }

        $io->success('Fin de la récupération des personnages');

        return Command::SUCCESS;
    }
}
