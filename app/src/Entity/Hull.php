<?php

namespace App\Entity;

use App\Repository\HullRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HullRepository::class)]
class Hull
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'hulls')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehicle $vehicle = null;

    #[ORM\Column]
    private array $armor = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getArmor(): array
    {
        return $this->armor;
    }

    public function setArmor(array $armor): self
    {
        $this->armor = $armor;

        return $this;
    }
}
