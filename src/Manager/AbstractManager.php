<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:59.
 */

declare(strict_types=1);

namespace App\Manager;

use App\Entity\StorableEntityInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AbstractManager.
 */
class AbstractManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * AbstractServiceManager constructor.
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }

    public function save(StorableEntityInterface $entity): void
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function delete(StorableEntityInterface $entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }
}
