<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $level = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Nation $nation = null;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Hull::class, orphanRemoval: true)]
    private Collection $hulls;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Chassis::class, orphanRemoval: true)]
    private Collection $chassis;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Turret::class, orphanRemoval: true)]
    private Collection $turrets;

    public function __construct()
    {
        $this->hulls = new ArrayCollection();
        $this->chassis = new ArrayCollection();
        $this->turrets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getNation(): ?Nation
    {
        return $this->nation;
    }

    public function setNation(?Nation $nation): self
    {
        $this->nation = $nation;

        return $this;
    }

    /**
     * @return Collection<int, Hull>
     */
    public function getHulls(): Collection
    {
        return $this->hulls;
    }

    public function addHull(Hull $hull): self
    {
        if (!$this->hulls->contains($hull)) {
            $this->hulls->add($hull);
            $hull->setVehicle($this);
        }

        return $this;
    }

    public function removeHull(Hull $hull): self
    {
        if ($this->hulls->removeElement($hull)) {
            // set the owning side to null (unless already changed)
            if ($hull->getVehicle() === $this) {
                $hull->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chassis>
     */
    public function getChassis(): Collection
    {
        return $this->chassis;
    }

    public function addChassis(Chassis $chassis): self
    {
        if (!$this->chassis->contains($chassis)) {
            $this->chassis->add($chassis);
            $chassis->setVehicle($this);
        }

        return $this;
    }

    public function removeChassis(Chassis $chassis): self
    {
        if ($this->chassis->removeElement($chassis)) {
            // set the owning side to null (unless already changed)
            if ($chassis->getVehicle() === $this) {
                $chassis->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Turret>
     */
    public function getTurrets(): Collection
    {
        return $this->turrets;
    }

    public function addTurret(Turret $turret): self
    {
        if (!$this->turrets->contains($turret)) {
            $this->turrets->add($turret);
            $turret->setVehicle($this);
        }

        return $this;
    }

    public function removeTurret(Turret $turret): self
    {
        if ($this->turrets->removeElement($turret)) {
            // set the owning side to null (unless already changed)
            if ($turret->getVehicle() === $this) {
                $turret->setVehicle(null);
            }
        }

        return $this;
    }
}
