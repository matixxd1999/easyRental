<?php

namespace App\Entity;

use App\Repository\BillingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillingsRepository::class)]
class Billings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $price;

    #[ORM\ManyToOne(targetEntity: Apartments::class, inversedBy: 'billing')]
    private $apartments;

    #[ORM\OneToMany(mappedBy: 'billings', targetEntity: DictPeriods::class)]
    private $period;

    public function __construct()
    {
        $this->period = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getApartments(): ?Apartments
    {
        return $this->apartments;
    }

    public function setApartments(?Apartments $apartments): self
    {
        $this->apartments = $apartments;

        return $this;
    }

    /**
     * @return Collection<int, DictPeriods>
     */
    public function getPeriod(): Collection
    {
        return $this->period;
    }

    public function addPeriod(DictPeriods $period): self
    {
        if (!$this->period->contains($period)) {
            $this->period[] = $period;
            $period->setBillings($this);
        }

        return $this;
    }

    public function removePeriod(DictPeriods $period): self
    {
        if ($this->period->removeElement($period)) {
            // set the owning side to null (unless already changed)
            if ($period->getBillings() === $this) {
                $period->setBillings(null);
            }
        }

        return $this;
    }
}
