<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 06/02/2020
 * Time: 14:04.
 */

namespace App\Entity;

use DateTime;

/**
 * Class BaseLanguage.
 */
class BaseLanguage
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="word", type="string", length=255)
     */
    protected $word;

    /**
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(name="Exemple", type="string", length=255, nullable=true)
     */
    protected $exemple;

    /**
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    protected $url;

    /**
     * @ORM\Column(name="Type", type="string", length=30)
     */
    protected $type;

    /**
     * @ORM\Column(name="Language", type="string",length=10, nullable=true)
     */
    protected $language;

    /**
     * @ORM\Column(name="Status", type="boolean")
     */
    protected $status;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

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
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @param string $word
     *
     * @return $this
     */
    public function setWord(string $word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getExemple()
    {
        return $this->exemple;
    }

    /**
     * @param string $exemple
     *
     * @return $this
     */
    public function setExemple(string $exemple)
    {
        $this->exemple = $exemple;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return $this
     */
    public function setLanguage(string $language)
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
    public function getCreatedAt()
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
    public function getUpdatedAt()
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
}
