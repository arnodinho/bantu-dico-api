<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @codeCoverageIgnore
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(name="firstname", type="string", nullable=true)
     */
    private string $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", nullable=true)
     */
    private string $lastname;

    /**
     * @ORM\Column(name="gender", type="string", nullable=true)
     */
    private string $gender;

    /**
     * @var string
     */
    protected string $username;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FrenchSango", mappedBy="user")
     */
    private $frenchSangos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FrenchLingala", mappedBy="user")
     */
    private $frenchLingalas;



    public function __construct()
    {
        $this->frenchSangos = new ArrayCollection();
        $this->frenchLingalas = new ArrayCollection();
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
    public function getUsername(): string
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname(string $firstname): User
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname(string $lastname): User
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return User
     */
    public function setGender(string $gender): User
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return Collection|FrenchSango[]
     */
    public function getFrenchSangos(): Collection
    {
        return $this->frenchSangos;
    }

    public function addFrenchSango(FrenchSango $frenchSango): self
    {
        if (!$this->frenchSangos->contains($frenchSango)) {
            $this->frenchSangos[] = $frenchSango;
            $frenchSango->setUser($this);
        }

        return $this;
    }

    public function removeFrenchSango(FrenchSango $frenchSango): self
    {
        if ($this->frenchSangos->contains($frenchSango)) {
            $this->frenchSangos->removeElement($frenchSango);
            // set the owning side to null (unless already changed)
            if ($frenchSango->getUser() === $this) {
                $frenchSango->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FrenchLingala[]
     */
    public function getFrenchLingalas(): Collection
    {
        return $this->frenchLingalas;
    }

    public function addFrenchLingala(FrenchLingala $frenchLingala): self
    {
        if (!$this->frenchLingalas->contains($frenchLingala)) {
            $this->frenchLingalas[] = $frenchLingala;
            $frenchLingala->setUser($this);
        }

        return $this;
    }

    public function removeFrenchLingala(FrenchLingala $frenchLingala): self
    {
        if ($this->frenchLingalas->contains($frenchLingala)) {
            $this->frenchLingalas->removeElement($frenchLingala);
            // set the owning side to null (unless already changed)
            if ($frenchLingala->getUser() === $this) {
                $frenchLingala->setUser(null);
            }
        }

        return $this;
    }
}
