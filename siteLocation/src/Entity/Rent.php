<?php

namespace App\Entity;

use App\Repository\RentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentRepository::class)
 */
class Rent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $bookingDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="rents")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Cars::class, inversedBy="rents")
     */
    private $cars;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getBookingDate(): ?\DateTimeInterface
    {
        return $this->bookingDate;
    }

    public function setBookingDate(\DateTimeInterface $bookingDate): self
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCars(): ?Cars
    {
        return $this->cars;
    }

    public function setCars(?Cars $cars): self
    {
        $this->cars = $cars;

        return $this;
    }
}
