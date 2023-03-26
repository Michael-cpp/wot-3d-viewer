<?php

namespace App\Entity;

use App\Repository\GunRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GunRepository::class)]
class Gun
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'guns')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Turret $turret = null;

    #[ORM\Column]
    private array $armor = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTurret(): ?Turret
    {
        return $this->turret;
    }

    public function setTurret(?Turret $turret): self
    {
        $this->turret = $turret;

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
