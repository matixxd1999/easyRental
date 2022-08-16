<?php

namespace App\Entity;

use App\Repository\DictRoomsKindsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DictRoomsKindsRepository::class)]
class DictRoomsKinds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Rooms::class, inversedBy: 'roomsKind')]
    private $rooms;

    #[ORM\ManyToMany(targetEntity: DictAccessories::class, inversedBy: 'dictRoomsKinds')]
    private $accessory;

    public function __construct()
    {
        $this->accessory = new ArrayCollection();
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

    public function getRooms(): ?Rooms
    {
        return $this->rooms;
    }

    public function setRooms(?Rooms $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * @return Collection<int, DictAccessories>
     */
    public function getAccessory(): Collection
    {
        return $this->accessory;
    }

    public function addAccessory(DictAccessories $accessory): self
    {
        if (!$this->accessory->contains($accessory)) {
            $this->accessory[] = $accessory;
        }

        return $this;
    }

    public function removeAccessory(DictAccessories $accessory): self
    {
        $this->accessory->removeElement($accessory);

        return $this;
    }
}
