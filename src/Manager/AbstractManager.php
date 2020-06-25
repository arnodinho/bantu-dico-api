<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:59.
 */

declare(strict_types=1);

namespace App\Manager;

use App\Cache\RedisCache;
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

    protected RedisCache $redis;

    /**
     * AbstractServiceManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->redis = RedisCache::getInstance();
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
