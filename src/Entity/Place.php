<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $siege = null;

    #[ORM\Column]
    private ?bool $siegeMobiliteReduite = null;

    #[ORM\ManyToOne(inversedBy: 'places')]
    private ?Reservation $reservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiege(): ?string
    {
        return $this->siege;
    }

    public function setSiege(string $siege): static
    {
        $this->siege = $siege;

        return $this;
    }

    public function isSiegeMobiliteReduite(): ?bool
    {
        return $this->siegeMobiliteReduite;
    }

    public function setSiegeMobiliteReduite(bool $siegeMobiliteReduite): static
    {
        $this->siegeMobiliteReduite = $siegeMobiliteReduite;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }
}
