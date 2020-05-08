<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 06/02/2020
 * Time: 14:04.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class BaseLanguage.
 *
 * @codeCoverageIgnore
 * @ORM\HasLifecycleCallbacks()
 */
class BaseLanguage implements StorableEntityInterface
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @ORM\Column(name="word", type="string", length=255)
     */
    protected string $word;

    /**
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    protected string $description;

    /**
     * @ORM\Column(name="Exemple", type="string", length=255, nullable=true)
     */
    protected string $exemple;

    /**
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    protected string $url;

    /**
     * @ORM\Column(name="Type", type="string", length=30)
     */
    protected string $type;

    /**
     * @ORM\Column(name="Language", type="string",length=10, nullable=true)
     */
    protected string $language;

    /**
     * @ORM\Column(name="Status", type="boolean")
     */
    protected bool $status;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected DateTime $updatedAt;

    /**
     * Unmapped property to handle file uploads
     */
    protected $file;


    /**
     * BaseLanguage constructor.
     */
    public function __construct()
    {
        $this->status = false;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * @param string $word
     *
     * @return $this
     */
    public function setWord(string $word): BaseLanguage
    {
        $this->word = $word;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): BaseLanguage
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getExemple(): string
    {
        return $this->exemple;
    }

    /**
     * @param string $exemple
     *
     * @return $this
     */
    public function setExemple(string $exemple): BaseLanguage
    {
        $this->exemple = $exemple;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): BaseLanguage
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): BaseLanguage
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return $this
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     *
     * @return $this
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if (null == $this->getCreatedAt()) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
}
