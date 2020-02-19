<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:59.
 */

declare(strict_types=1);

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AbstractManager.
 */
class AbstractManager
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * AbstractServiceManager constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return EntityManagerInterface
     */
    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }

    /**
     * @param  $entity
     */
    public function save($entity): void
    {
        if (!$this->em->contains($entity)) {
            $this->em->persist($entity);
        }

        $this->em->flush();
    }
}
