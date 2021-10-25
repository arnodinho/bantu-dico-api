<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FrenchLingalaRepository")
 *
 * @codeCoverageIgnore
 */
class FrenchLingala implements StorableEntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\French")
     */
    private French $french;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lingala")
     */
    private Lingala $lingala;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $status;

    /**
     * @ORM\Column(name="Votes", type="integer", nullable=true))
     */
    private int $votes;

    /**
     * @ORM\Column(name="Likes", type="integer", nullable=true)
     */
    private int $likes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="frenchLingalas")
     */
    private User $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $updatedAt;

    /**
     * @ORM\Column(name="description_french", type="string", length=255, nullable=true)
     */
    private string $descriptionSource;

    /**
     * @ORM\Column(name="description_lingala", type="string", length=255, nullable=true)
     */
    private $descriptionTarget;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrench(): ?French
    {
        return $this->french;
    }

    /**
     * @return $this
     */
    public function setFrench(?French $french): self
    {
        $this->french = $french;

        return $this;
    }

    public function getLingala(): ?Lingala
    {
        return $this->lingala;
    }

    /**
     * @return $this
     */
    public function setLingala(?Lingala $lingala): self
    {
        $this->lingala = $lingala;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @return $this
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getVotes(): ?string
    {
        return $this->votes;
    }

    /**
     * @return $this
     */
    public function setVotes(?string $votes): self
    {
        $this->votes = $votes;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    /**
     * @return $this
     */
    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @return $this
     */
    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDescriptionSource(): ?string
    {
        return $this->descriptionSource;
    }

    public function setDescriptionSource(?string $descriptionSource): self
    {
        $this->descriptionSource = $descriptionSource;

        return $this;
    }

    public function getDescriptionTarget(): ?string
    {
        return $this->descriptionTarget;
    }

    /**
     * @return $this
     */
    public function setDescriptionTarget(?string $descriptionTarget): self
    {
        $this->descriptionTarget = $descriptionTarget;

        return $this;
    }
}
