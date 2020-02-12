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
     * @var mixed
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
    protected  $language;

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
    private $file;


    /**
     * BaseLanguage constructor.
     */
    public function __construct()
    {
        $this->status = false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @param mixed $word
     *
     * @return $this
     */
    public function setWord($word)
    {
        $this->word = $word;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExemple()
    {
        return $this->exemple;
    }

    /**
     * @param mixed $exemple
     * @return $this
     */
    public function setExemple($exemple)
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
     * @param mixed $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     * @return $this
     */
    public function setLanguage($language)
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
     * @return $this
     */
    public function setStatus(bool $status): BaseLanguage
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return BaseLanguage
     */
    public function setCreatedAt($createdAt)
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
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
