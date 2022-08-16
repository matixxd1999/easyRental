<?php

namespace App\Entity;

use App\Repository\RoomsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomsRepository::class)]
class Rooms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'rooms', targetEntity: DictRoomsKinds::class)]
    private $roomsKind;

    #[ORM\ManyToMany(targetEntity: DictAccessories::class, inversedBy: 'rooms')]
    private $accessory;

    #[ORM\ManyToOne(targetEntity: Images::class, inversedBy: 'rooms')]
    private $image;

    public function __construct()
    {
        $this->roomsKind = new ArrayCollection();
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

    public function setName(?string $name): self
    {
        $this->name = $name;

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
     * @return Collection<int, DictRoomsKinds>
     */
    public function getRoomsKind(): Collection
    {
        return $this->roomsKind;
    }

    public function addRoomsKind(DictRoomsKinds $roomsKind): self
    {
        if (!$this->roomsKind->contains($roomsKind)) {
            $this->roomsKind[] = $roomsKind;
            $roomsKind->setRooms($this);
        }

        return $this;
    }

    public function removeRoomsKind(DictRoomsKinds $roomsKind): self
    {
        if ($this->roomsKind->removeElement($roomsKind)) {
            // set the owning side to null (unless already changed)
            if ($roomsKind->getRooms() === $this) {
                $roomsKind->setRooms(null);
            }
        }

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

    public function getImage(): ?Images
    {
        return $this->image;
    }

    public function setImage(?Images $image): self
    {
        $this->image = $image;

        return $this;
    }
}
