<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'integer')]
    private $phoneNumber;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'datetime')]
    private $dateCreate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateUpdate;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateExpire;

    #[ORM\ManyToMany(targetEntity: Admins::class, inversedBy: 'users')]
    private $someAdmin;

    #[ORM\ManyToOne(targetEntity: Rentals::class, inversedBy: 'user')]
    private $rentals;

    #[ORM\OneToOne(targetEntity: Tokens::class, cascade: ['persist', 'remove'])]
    private $tokens;

    public function __construct()
    {
        $this->someAdmin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->dateUpdate;
    }

    public function setDateUpdate(?\DateTimeInterface $dateUpdate): self
    {
        $this->dateUpdate = $dateUpdate;

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

    /**
     * @return Collection<int, Admins>
     */
    public function getSomeAdmin(): Collection
    {
        return $this->someAdmin;
    }

    public function addSomeAdmin(Admins $someAdmin): self
    {
        if (!$this->someAdmin->contains($someAdmin)) {
            $this->someAdmin[] = $someAdmin;
        }

        return $this;
    }

    public function removeSomeAdmin(Admins $someAdmin): self
    {
        $this->someAdmin->removeElement($someAdmin);

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

    public function getDateExpire(): ?\DateTimeInterface
    {
        return $this->dateExpire;
    }

    public function setDateExpire(?\DateTimeInterface $dateExpire): self
    {
        $this->dateExpire = $dateExpire;

        return $this;
    }

    public function getTokens(): ?Tokens
    {
        return $this->tokens;
    }

    public function setTokens(?Tokens $tokens): self
    {
        $this->tokens = $tokens;

        return $this;
    }
}
