<?php

namespace App\EventSubscriber;

use App\Repository\SortilegeRepository;
use App\Service\HarryPotterApi;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;
class SortilegeSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $sortilegeRepository;
    private $hapi;
    
    public function __construct(Environment $twig, SortilegeRepository $sortilegeRepository,HarryPotterApi $hapi)
    {
        $this->twig = $twig;
        $this->sortilegeRepository = $sortilegeRepository;
        $this->hapi = $hapi;
    }
    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('sortileges', $this->sortilegeRepository->findAll());
        $this->twig->addGlobal('personnages', $this->hapi->getCharactersFromApi());
    }
        
    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}

