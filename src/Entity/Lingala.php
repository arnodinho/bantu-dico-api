<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LingalaRepository")
 *
 * @codeCoverageIgnore
 */
class Lingala extends BaseLanguage
{
    public const PATH_AUDIO = '/bundles/main/audio/lingala/';
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
