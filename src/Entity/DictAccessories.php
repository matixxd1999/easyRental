<?php

namespace App\Entity;

use App\Repository\DictAccessoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DictAccessoriesRepository::class)]
class DictAccessories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Rooms::class, mappedBy: 'accessory')]
    private $rooms;

    #[ORM\ManyToMany(targetEntity: DictRoomsKinds::class, mappedBy: 'accessory')]
    private $dictRoomsKinds;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->dictRoomsKinds = new ArrayCollection();
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
     * @return Collection<int, Rooms>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Rooms $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->addAccessory($this);
        }

        return $this;
    }

    public function removeRoom(Rooms $room): self
    {
        if ($this->rooms->removeElement($room)) {
            $room->removeAccessory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, DictRoomsKinds>
     */
    public function getDictRoomsKinds(): Collection
    {
        return $this->dictRoomsKinds;
    }

    public function addDictRoomsKind(DictRoomsKinds $dictRoomsKind): self
    {
        if (!$this->dictRoomsKinds->contains($dictRoomsKind)) {
            $this->dictRoomsKinds[] = $dictRoomsKind;
            $dictRoomsKind->addAccessory($this);
        }

        return $this;
    }

    public function removeDictRoomsKind(DictRoomsKinds $dictRoomsKind): self
    {
        if ($this->dictRoomsKinds->removeElement($dictRoomsKind)) {
            $dictRoomsKind->removeAccessory($this);
        }

        return $this;
    }
}
