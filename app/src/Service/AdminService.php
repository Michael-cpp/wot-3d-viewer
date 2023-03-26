<?php



namespace App\Service;

use App\Entity\Chassis;
use App\Entity\Gun;
use App\Entity\Hull;
use App\Entity\Nation;
use App\Entity\Turret;
use App\Entity\Vehicle;
use App\Repository\NationRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;


class AdminService
{
    private $vehicleRepository;
    private $wotXmlReaderService;
    private $havokService;
    private $em;
    private $nationRepository;

    public function __construct(
        VehicleRepository $vehicleRepository,
        EntityManagerInterface $em,
        NationRepository $nationRepository
    ) {
        $this->vehicleRepository = $vehicleRepository;
        $this->em = $em;
        $this->nationRepository = $nationRepository;
    }

    public function import(): void
    {

    }
}