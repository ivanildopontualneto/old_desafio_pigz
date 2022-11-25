<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Client;
use App\Repository\ClientRepository;


class ClientController extends AbstractController
{
    ##<--Endpoint que lista todos os clientes-->
    #[Route('/clients', name: 'clients_list', methods: ['GET'])]
    public function index(ClientRepository $clientRepository): JsonResponse
    {   
        ##Refazer Listagem
        return $this->json([
            
        ]);
    }

    ##<--Endpoint que retorna um cliente com o id passado por parâmetro-->
    #[Route('/clients/{client}', name: 'clients_single', methods: ['GET'])]
    public function single(int $client, ClientRepository $clientRepository): JsonResponse
    {   
        $client = $clientRepository->find($client);
        
        if(!$client) throw $this->createNotFoundException();

        return $this->json([
            'data' => $client,
        ]);
    }

    ##<-- Endpoint que cria novos clientes-->
    #[Route('/clients', name: 'clients_create', methods: ['POST'])]
    public function create(Request $request, ClientRepository $clientRepository): JsonResponse
    {
        $data = $request->request->all();

        $client = new Client();
        $client->setName($data['name']);
        $client->setDoc($data['doc']);

        $clientRepository->save($client, true);

        return $this->json([
            'message' => 'Client created successfully!',
        ], 201);
    }
}