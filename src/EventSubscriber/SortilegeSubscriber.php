<?php

namespace App\EventSubscriber;

use App\Repository\SortilegeRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;
class SortilegeSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $sortilegeRepository;
    
    public function __construct(Environment $twig, SortilegeRepository $sortilegeRepository)
    {
        $this->twig = $twig;
        $this->sortilegeRepository = $sortilegeRepository;
    }
    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('sortileges', $this->sortilegeRepository->findAll());
    }
        
    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}

