<?php

namespace App\Service;

use App\Entity\Sortilege;
use App\Repository\SortilegeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HarryPotterApi{
    private const BASE_URL = "https://hp-api.onrender.com/api";
    private HttpClientInterface $client;
    private EntityManagerInterface $entityManager;
    private SortilegeRepository $sortilegeRepository;

    public function __construct(HttpClientInterface $client,EntityManagerInterface $entityManager,SortilegeRepository $sortilegeRepository)
    {
        $this->client = $client;
        $this->sortilegeRepository = $sortilegeRepository;
        $this->entityManager = $entityManager;
    }

    public function getSpellFromApi(){
       $response = $this->client->request("GET",$this::BASE_URL."/spells");
       try{    
            $spells = $response->toArray();
            foreach($spells as $spell){
                
                $sort = $this->sortilegeRepository->findOneBy(["externalId"=>$spell["id"]]);
                if(!$sort){
                    $sort = new Sortilege();
                    $sort->setArchive(False);
                    $sort->setExternalId($spell["id"]);
                    $this->entityManager->persist($sort);
                }
                $sort->setNom($spell["name"]);
                $sort->setDescription($spell["description"]);
            }
            $this->entityManager->flush();

        }catch(Exception $e){
            return False;
        }
       return True;
    }

    public function getCharactersFromApi(){
       $response = $this->client->request("GET",$this::BASE_URL."/characters");
        
       return $response->toArray();
    }

}