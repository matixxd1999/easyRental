<?php

namespace App\Entity;

use App\Repository\TokensRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TokensRepository::class)]
class Tokens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $code;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $activeAccount;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dataExpire;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $nextEmailTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(?int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function isActiveAccount(): ?bool
    {
        return $this->activeAccount;
    }

    public function setActiveAccount(?bool $activeAccount): self
    {
        $this->activeAccount = $activeAccount;

        return $this;
    }

    public function getDataExpire(): ?\DateTimeInterface
    {
        return $this->dataExpire;
    }

    public function setDataExpire(?\DateTimeInterface $dataExpire): self
    {
        $this->dataExpire = $dataExpire;

        return $this;
    }

    public function getNextEmailTime(): ?\DateTimeInterface
    {
        return $this->nextEmailTime;
    }

    public function setNextEmailTime(?\DateTimeInterface $nextEmailTime): self
    {
        $this->nextEmailTime = $nextEmailTime;

        return $this;
    }
}
