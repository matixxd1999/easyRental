<?php

namespace App\Entity;

use App\Repository\DictPeriodsNumberKindsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DictPeriodsNumberKindsRepository::class)]
class DictPeriodsNumberKinds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $limitMax;

    #[ORM\ManyToOne(targetEntity: DictPeriods::class, inversedBy: 'numberKind')]
    private $dictPeriods;

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

    public function getLimitMax(): ?int
    {
        return $this->limitMax;
    }

    public function setLimitMax(int $limitMax): self
    {
        $this->limitMax = $limitMax;

        return $this;
    }

    public function getDictPeriods(): ?DictPeriods
    {
        return $this->dictPeriods;
    }

    public function setDictPeriods(?DictPeriods $dictPeriods): self
    {
        $this->dictPeriods = $dictPeriods;

        return $this;
    }
}
