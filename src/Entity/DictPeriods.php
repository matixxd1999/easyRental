<?php

namespace App\Entity;

use App\Repository\DictPeriodsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DictPeriodsRepository::class)]
class DictPeriods
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $number;

    #[ORM\ManyToOne(targetEntity: Billings::class, inversedBy: 'period')]
    private $billings;

    #[ORM\OneToMany(mappedBy: 'dictPeriods', targetEntity: DictPeriodsNumberKinds::class)]
    private $numberKind;

    public function __construct()
    {
        $this->numberKind = new ArrayCollection();
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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getBillings(): ?Billings
    {
        return $this->billings;
    }

    public function setBillings(?Billings $billings): self
    {
        $this->billings = $billings;

        return $this;
    }

    /**
     * @return Collection<int, DictPeriodsNumberKinds>
     */
    public function getNumberKind(): Collection
    {
        return $this->numberKind;
    }

    public function addNumberKind(DictPeriodsNumberKinds $numberKind): self
    {
        if (!$this->numberKind->contains($numberKind)) {
            $this->numberKind[] = $numberKind;
            $numberKind->setDictPeriods($this);
        }

        return $this;
    }

    public function removeNumberKind(DictPeriodsNumberKinds $numberKind): self
    {
        if ($this->numberKind->removeElement($numberKind)) {
            // set the owning side to null (unless already changed)
            if ($numberKind->getDictPeriods() === $this) {
                $numberKind->setDictPeriods(null);
            }
        }

        return $this;
    }
}
