<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:56.
 */

declare(strict_types=1);

namespace App\Manager;

use App\Cache\RedisCache;
use App\Entity\Page;
use App\Entity\StorableEntityInterface;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PageManager.
 */
class PageManager extends AbstractManager implements ManagerInterface
{
    public const REDIS_PAGE_NAMESPACE = 'Page';

    /**
     * @var PageRepository
     */
    protected $repository;

    /**
     * @var RedisCache
     */
    protected $redis;


    /**
     * PageManager constructor.
     *
     * @param EntityManagerInterface $em
     * @param RedisCache $redis
     */
    public function __construct(EntityManagerInterface $em, RedisCache $redis)
    {
        parent::__construct($em);

        $this->redis = $redis;
        $this->repository = $this->getEntityManager()->getRepository(Page::class);
    }

    /**
     * @param int $id
     * @return StorableEntityInterface|bool|null
     */
    public function findById(int $id)
    {
        if ($page = $this->redis->get($id, self::REDIS_PAGE_NAMESPACE)) {
            return $page;
        }

        $page = $this->repository->find($id);
        $this->redis->set($id, $page, self::REDIS_PAGE_NAMESPACE);

        return $page;
    }

    /**
     * @return Page[]|object[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
