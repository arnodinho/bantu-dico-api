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
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    protected function mockFindById($model): void
    {
        $this->repository->find(
            Argument::is($model->getId())
        )
            ->shouldBeCalledOnce()
            ->willReturn($model);
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
