<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SangoRepository")
 *
 * @codeCoverageIgnore
 */
class Sango extends BaseLanguage
{
    const PATH_AUDIO = '/public/bundles/main/audio/sango/';
    const CODE_LANGUAGE_AUDIO = 'es';
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
