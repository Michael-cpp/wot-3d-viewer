<?php

namespace App\Service;

use App\Repository\VehicleRepository;

class NationService
{
    private $vehicleRepository;

    public function __construct( VehicleRepository $vehicleRepository) {
        $this->vehicleRepository = $vehicleRepository;
    }
    public function getGroupedVehicles(String $nationId): array
    {
        $vehicles = $this->vehicleRepository->findBy(['nation' => $nationId],['level' => 'ASC']);
        $vehicles_sorted = [];
        foreach($vehicles as $item) {
            if(!isset($vehicles_sorted[$item->getLevel()])) {
                $vehicles_sorted[$item->getLevel()] = [];
            }
            $vehicles_sorted[$item->getLevel()][] = $item;
        }
        ksort($vehicles_sorted, SORT_NUMERIC);
        return $vehicles_sorted;
    }
}