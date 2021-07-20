<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsRepository::class)
 */
class Cars
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $availability;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $plate;

    /**
     * @ORM\OneToMany(targetEntity=Rent::class, mappedBy="cars")
     */
    private $rents;

    /**
     * @ORM\ManyToOne(targetEntity=CarFleet::class, inversedBy="cars")
     */
    private $carFleet;

    /**
     * @ORM\ManyToOne(targetEntity=Seats::class, inversedBy="cars")
     */
    private $seat;

    /**
     * @ORM\ManyToOne(targetEntity=Engines::class, inversedBy="cars")
     */
    private $engine;

    /**
     * @ORM\ManyToOne(targetEntity=Brands::class, inversedBy="cars")
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity=Gears::class, inversedBy="cars")
     */
    private $gear;

    public function __construct()
    {
        $this->rents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getPlate(): ?string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): self
    {
        $this->plate = $plate;

        return $this;
    }

    /**
     * @return Collection|Rent[]
     */
    public function getRents(): Collection
    {
        return $this->rents;
    }

    public function addRent(Rent $rent): self
    {
        if (!$this->rents->contains($rent)) {
            $this->rents[] = $rent;
            $rent->setCars($this);
        }

        return $this;
    }

    public function removeRent(Rent $rent): self
    {
        if ($this->rents->removeElement($rent)) {
            // set the owning side to null (unless already changed)
            if ($rent->getCars() === $this) {
                $rent->setCars(null);
            }
        }

        return $this;
    }

    public function getCarFleet(): ?CarFleet
    {
        return $this->carFleet;
    }

    public function setCarFleet(?CarFleet $carFleet): self
    {
        $this->carFleet = $carFleet;

        return $this;
    }

    public function getSeat(): ?Seats
    {
        return $this->seat;
    }

    public function setSeat(?Seats $seat): self
    {
        $this->seat = $seat;

        return $this;
    }

    public function getEngine(): ?Engines
    {
        return $this->engine;
    }

    public function setEngine(?Engines $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    public function getBrand(): ?Brands
    {
        return $this->brand;
    }

    public function setBrand(?Brands $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getGear(): ?Gears
    {
        return $this->gear;
    }

    public function setGear(?Gears $gear): self
    {
        $this->gear = $gear;

        return $this;
    }
}
