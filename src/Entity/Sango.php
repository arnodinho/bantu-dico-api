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
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected int $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
