<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FrenchRepository")
 * @ORM\HasLifecycleCallbacks()
 * @codeCoverageIgnore
 */
class French extends BaseLanguage
{
    public const PATH_AUDIO = '/public/bundles/main/audio/french/';
    public const CODE_LANGUAGE_AUDIO = 'fr';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if (empty($this->getCreatedAt())) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
}
