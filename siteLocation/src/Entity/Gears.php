<?php

namespace App\Entity;

use App\Repository\GearsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GearsRepository::class)
 */
class Gears
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
    private $gear;

    /**
     * @ORM\OneToMany(targetEntity=Cars::class, mappedBy="gear")
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

    public function getGear(): ?string
    {
        return $this->gear;
    }

    public function setGear(string $gear): self
    {
        $this->gear = $gear;

        return $this;
    }
    public function __toString()
    {
        return $this->gear;
    }

    /**
     * @return Collection|Cars[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Cars $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setGear($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getGear() === $this) {
                $car->setGear(null);
            }
        }

        return $this;
    }
}
