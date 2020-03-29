<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FrenchSangoRepository")
 *
 * @codeCoverageIgnore
 */
class FrenchSango
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Sango")
     */
    private Sango $Sango;

    /**
     * @ORM\Column(name="Votes", type="integer", nullable=true)
     */
    private int $votes;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $status;

    /**
     * @ORM\Column(name="Likes", type="integer", nullable=true)
     */
    private int $likes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="frenchSangos")
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
     * @ORM\Column(name="description_sango", type="string", length=255, nullable=true)
     */
    private $descriptionTarget;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return French|null
     */
    public function getFrench(): ?French
    {
        return $this->french;
    }

    /**
     * @param French|null $french
     * @return $this
     */
    public function setFrench(?French $french): self
    {
        $this->french = $french;

        return $this;
    }

    /**
     * @return Sango|null
     */
    public function getSango(): ?Sango
    {
        return $this->Sango;
    }

    /**
     * @param Sango|null $Sango
     * @return $this
     */
    public function setSango(?Sango $Sango): self
    {
        $this->Sango = $Sango;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVotes(): ?int
    {
        return $this->votes;
    }

    /**
     * @param int|null $votes
     * @return $this
     */
    public function setVotes(?int $votes): self
    {
        $this->votes = $votes;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLikes(): ?int
    {
        return $this->likes;
    }

    /**
     * @param int|null $likes
     * @return $this
     */
    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescriptionSource(): ?string
    {
        return $this->descriptionSource;
    }

    /**
     * @param string|null $descriptionSource
     * @return $this
     */
    public function setDescriptionSource(?string $descriptionSource): self
    {
        $this->descriptionSource = $descriptionSource;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescriptionTarget(): ?string
    {
        return $this->descriptionTarget;
    }

    /**
     * @param string|null $descriptionTarget
     * @return $this
     */
    public function setDescriptionTarget(?string $descriptionTarget): self
    {
        $this->descriptionTarget = $descriptionTarget;

        return $this;
    }
}
