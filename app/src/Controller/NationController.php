<?php

namespace App\Controller;

use App\Repository\NationRepository;
use App\Repository\VehicleRepository;
use App\Service\NationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NationController extends AbstractController
{
    #[Route('/', name: 'nation')]
    public function index(NationRepository $nationRepository): Response
    {
        $nations = $nationRepository->findAll();

        return $this->render('nation/nation-list.html.twig', [
            'nations' => $nations,
        ]);
    }

    #[Route('/nation/{id}', name: 'tree')]
    public function showTree(String $id, NationService $nationService): Response
    {
        $vehicles = $nationService->getGroupedVehicles($id);

        return $this->render('nation/tree.html.twig', [
            'vehicles' => $vehicles,
        ]);
    }
}
