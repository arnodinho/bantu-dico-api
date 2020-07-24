<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 06/02/2020
 * Time: 14:04.
 */

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;

/**
 * Class BaseLanguage.
 *
 * @codeCoverageIgnore
 */
class BaseLanguage implements StorableEntityInterface
{
    /**
     * @SWG\Property(format="int64")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="word", type="string", length=255)
     */
    protected $word;

    /**
     * @SWG\Property()
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @SWG\Property()
     * @ORM\Column(name="Exemple", type="string", length=255, nullable=true)
     */
    protected $exemple;

    /**
     * @SWG\Property()
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    protected $url;

    /**
     * @SWG\Property(enum={"nom", "pronom", "verbe", "adjectif"})
     * @ORM\Column(name="Type", type="string", length=30)
     */
    protected $type;

    /**
     * @SWG\Property()
     * @ORM\Column(name="Language", type="string",length=10, nullable=true)
     */
    protected $language;

    /**
     * @SWG\Property()
     * @ORM\Column(name="Status", type="boolean")
     */
    protected $status;

    /**
     * @SWG\Property()
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @SWG\Property()
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * @SWG\Property()
     * Unmapped property to handle file uploads.
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
     * @return $this
     */
    public function setId(int $id): BaseLanguage
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getWord(): ?string
    {
        return $this->word;
    }

    /**
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
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
    public function getExemple(): ?string
    {
        return $this->exemple;
    }

    /**
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
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
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
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
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
    public function isStatus(): ?bool
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

    /**
     * @return DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
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
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
