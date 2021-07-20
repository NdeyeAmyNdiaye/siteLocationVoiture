<?php

namespace App\Entity;

use App\Repository\EnginesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnginesRepository::class)
 */
class Engines
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $engine;

    /**
     * @ORM\OneToMany(targetEntity=cars::class, mappedBy="engine")
     */
    private $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function setEngine(string $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * @return Collection|cars[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(cars $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setEngine($this);
        }

        return $this;
    }

    public function removeCar(cars $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getEngine() === $this) {
                $car->setEngine(null);
            }
        }

        return $this;
    }
}
