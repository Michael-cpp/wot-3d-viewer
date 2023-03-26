<?php
namespace App\Service;

use App\Repository\VehicleRepository;
use phpDocumentor\Reflection\Types\Integer;

class VehicleService
{
    private $vehicleRepository;
    public function __construct(
        VehicleRepository $vehicleRepository,
    ) {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function getAsArray(String $id): array
    {
        $vehicle = $this->vehicleRepository->findOneBy(['id' => $id]);

        $chassis = [];
        foreach($vehicle->getChassis() as $item) {
            $chassis[] = [
                'armor' => $item->getArmor(),
            ];
        }
        $hull = [];
        foreach($vehicle->getHulls() as $item) {
            $hull[] = [
                'armor' => $item->getArmor(),
            ];
        }
        $turret = [];
        foreach($vehicle->getTurrets() as $item) {
            $guns = [];
            foreach($item->getGuns() as $gun) {
                $guns[] = [
                    'armor' => $gun->getArmor(),
                ];
            }
            $turret[] = [
                'armor' => $item->getArmor(),
                'gun' => $guns,
            ];
        }

        $vehicle_array = [
            'name' => $vehicle->getName(),
            'level' => $vehicle->getLevel(),
            'nation' => $vehicle->getNation()->getName(),
            'chassis' => $chassis,
            'hull' => $hull,
            'turret' => $turret,
        ];
        return $vehicle_array;
    }
}