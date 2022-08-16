<?php

namespace App\Entity;

use App\Repository\DictCountriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DictCountriesRepository::class)]
class DictCountries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Estates::class)]
    private $estates;

    public function __construct()
    {
        $this->estates = new ArrayCollection();
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

    /**
     * @return Collection<int, Estates>
     */
    public function getEstates(): Collection
    {
        return $this->estates;
    }

    public function addEstate(Estates $estate): self
    {
        if (!$this->estates->contains($estate)) {
            $this->estates[] = $estate;
            $estate->setCountry($this);
        }

        return $this;
    }

    public function removeEstate(Estates $estate): self
    {
        if ($this->estates->removeElement($estate)) {
            // set the owning side to null (unless already changed)
            if ($estate->getCountry() === $this) {
                $estate->setCountry(null);
            }
        }

        return $this;
    }

}
