<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 20:44.
 */

namespace App\Tests;

use App\Entity\StorableEntityInterface;
use App\Handler\ElasticHandler;
use App\Manager\PageManager;
use App\Repository\PageRepository;
use FOS\ElasticaBundle\Elastica\Index;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class AbstractManagerTest.
 */
class AbstractManagerTest extends AbstractTest
{
    /**
     * @var ObjectProphecy
     */
    protected $indexElasticSearch;

    /**
     * @var PageRepository
     */
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->indexElasticSearch = $this->prophesize(Index::class)->reveal();
    }

    /**
     * @param string $class
     */
    protected function mockRepository($class): void
    {
        $this->em->getRepository(
            Argument::is($class)
        )->willReturn($this->repository);
    }

    protected function mockFindById(int $id, StorableEntityInterface $model): void
    {
        $this->repository->find(
            Argument::is($id)
        )
            ->shouldBeCalledOnce()
            ->willReturn($model);
    }

    protected function mockFindByIdWithRedis(int $id, $model = null): void
    {
        $this->redis->get(
            Argument::is($id),
            Argument::is(PageManager::REDIS_PAGE_NAMESPACE)
        )
            ->shouldBeCalled()
            ->willReturn($model);
    }

    public function mockRedisSetData(int $id, StorableEntityInterface $entity, string $namespace): void
    {
        $this->redis->set(
            Argument::is($id),
            Argument::is($entity),
            Argument::is($namespace)
        )
            ->shouldBeCalledOnce();
    }

    protected function mockFindAll($modelTab): void
    {
        $this->repository->findAll()
            ->shouldBeCalledOnce()
            ->willReturn($modelTab);
    }
    protected function mockSearch(array $model): void
    {
        $elasticHandler = $this->prophesize(ElasticHandler::class);
        $elasticHandler->formatDateFormArrayResult(Argument::is('array'))
            ->shouldBeCalled()
            ->willReturn($model)

        ;
    }
}
