<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use App\Service\VehicleService;
use App\Entity\Vehicle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ViewerController extends AbstractController
{
    private $vehicleService;
    private $vehicleRepository;
    public function __construct( VehicleService $vehicleService, VehicleRepository $vehicleRepository )
    {
        $this->vehicleService = $vehicleService;
        $this->vehicleRepository = $vehicleRepository;
    }


    #[Route('/viewer/{id}', name: 'viewer')]

    public function index(String $id): Response
    {
        $vehicle = $this->vehicleRepository->findOneBy(['id' => $id]);
        if(!$vehicle) {
            throw $this->createNotFoundException('Vehicle not found');
        }
        $vehicleArray = $this->vehicleService->getAsArray($vehicle->getId());

        return $this->render('viewer/viewer.html.twig', [
            'vehicle' => $vehicleArray,
        ]);
    }
}
