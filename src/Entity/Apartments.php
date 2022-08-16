<?php

namespace App\Entity;

use App\Repository\ApartmentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApartmentsRepository::class)]
class Apartments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $number;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'apartments', targetEntity: Billings::class)]
    private $billing;

    #[ORM\ManyToOne(targetEntity: Rentals::class, inversedBy: 'apartment')]
    private $rentals;

    public function __construct()
    {
        $this->billing = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Billings>
     */
    public function getBilling(): Collection
    {
        return $this->billing;
    }

    public function addBilling(Billings $billing): self
    {
        if (!$this->billing->contains($billing)) {
            $this->billing[] = $billing;
            $billing->setApartments($this);
        }

        return $this;
    }

    public function removeBilling(Billings $billing): self
    {
        if ($this->billing->removeElement($billing)) {
            // set the owning side to null (unless already changed)
            if ($billing->getApartments() === $this) {
                $billing->setApartments(null);
            }
        }

        return $this;
    }

    public function getRentals(): ?Rentals
    {
        return $this->rentals;
    }

    public function setRentals(?Rentals $rentals): self
    {
        $this->rentals = $rentals;

        return $this;
    }
}
