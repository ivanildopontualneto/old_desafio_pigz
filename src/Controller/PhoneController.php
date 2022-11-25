<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Phone;
use App\Repository\PhoneRepository;
use App\Repository\ClientRepository;

class PhoneController extends AbstractController
{
    ##<-- Endpoint que lista todos os telefones de contato-->
    #[Route('/phones', name: 'phones_list', methods: ['GET'])]
    public function index(PhoneRepository $phoneRepository): JsonResponse
    {
        return $this->json([
            ##Refazer Listagem
        ]);
    }

    ##<-- Endpoint que cria novos telefones de contato para clientes já cadastrados-->
    #[Route('/phones', name: 'phones_create', methods: ['POST'])]
    public function create(Request $request, PhoneRepository $phoneRepository, ClientRepository $clientRepository): JsonResponse
    {
        $data = $request->request->all();

        $phone = new Phone();
        $phone->setNumber($data['number']);

        $clients = $clientRepository->findAll();

        foreach ($clients as $client) {
            if ($client->getId() == $data['client']) $phone->setClient($client);
        }
        
        ##if (!client) throw $this->createNotFoundException();
        
        $phoneRepository->save($phone, true);

        return $this->json([
            'message' => 'Phone created successfully!',
        ], 201);
    }    
    

}
