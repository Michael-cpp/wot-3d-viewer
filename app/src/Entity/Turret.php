<?php

namespace App\Entity;

use App\Repository\TurretRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TurretRepository::class)]
class Turret
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'turrets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehicle $vehicle = null;

    #[ORM\Column]
    private array $armor = [];

    #[ORM\OneToMany(mappedBy: 'turret', targetEntity: Gun::class, orphanRemoval: true)]
    private Collection $guns;

    public function __construct()
    {
        $this->guns = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Gun>
     */
    public function getGuns(): Collection
    {
        return $this->guns;
    }

    public function addGun(Gun $gun): self
    {
        if (!$this->guns->contains($gun)) {
            $this->guns->add($gun);
            $gun->setTurret($this);
        }

        return $this;
    }

    public function removeGun(Gun $gun): self
    {
        if ($this->guns->removeElement($gun)) {
            // set the owning side to null (unless already changed)
            if ($gun->getTurret() === $this) {
                $gun->setTurret(null);
            }
        }

        return $this;
    }
}
