<?php

namespace App\Entity;

use App\Repository\RentalsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentalsRepository::class)]
class Rentals
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $discount;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateFrom;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateTo;

    #[ORM\OneToMany(mappedBy: 'rentals', targetEntity: Users::class)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'rentals', targetEntity: Apartments::class)]
    private $apartment;

    #[ORM\OneToMany(mappedBy: 'rentals', targetEntity: DictStatusRentals::class)]
    private $statusy;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->apartment = new ArrayCollection();
        $this->status = new ArrayCollection();
        $this->statusy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function setDateFrom(?\DateTimeInterface $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    public function setDateTo(?\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Users $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setRentals($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRentals() === $this) {
                $user->setRentals(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Apartments>
     */
    public function getApartment(): Collection
    {
        return $this->apartment;
    }

    public function addApartment(Apartments $apartment): self
    {
        if (!$this->apartment->contains($apartment)) {
            $this->apartment[] = $apartment;
            $apartment->setRentals($this);
        }

        return $this;
    }

    public function removeApartment(Apartments $apartment): self
    {
        if ($this->apartment->removeElement($apartment)) {
            // set the owning side to null (unless already changed)
            if ($apartment->getRentals() === $this) {
                $apartment->setRentals(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DictStatusRentals>
     */
    public function getStatus(): Collection
    {
        return $this->statusy;
    }

    public function addStatus(DictStatusRentals $status): self
    {
        if (!$this->status->contains($status)) {
            $this->status[] = $status;
            $status->setRentals($this);
        }

        return $this;
    }

    public function removeStatus(DictStatusRentals $status): self
    {
        if ($this->status->removeElement($status)) {
            // set the owning side to null (unless already changed)
            if ($status->getRentals() === $this) {
                $status->setRentals(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DictStatusRentals>
     */
    public function getStatusy(): Collection
    {
        return $this->statusy;
    }

    public function addStatusy(DictStatusRentals $statusy): self
    {
        if (!$this->statusy->contains($statusy)) {
            $this->statusy[] = $statusy;
            $statusy->setRentals($this);
        }

        return $this;
    }

    public function removeStatusy(DictStatusRentals $statusy): self
    {
        if ($this->statusy->removeElement($statusy)) {
            // set the owning side to null (unless already changed)
            if ($statusy->getRentals() === $this) {
                $statusy->setRentals(null);
            }
        }

        return $this;
    }
}
