<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 20:44.
 */

namespace App\Tests;

use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Prophecy\Argument;

/**
 * Class AbstractManagerTest.
 */
class AbstractManagerTest extends AbstractTest
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var PageRepository
     */
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->em = $this->prophesize(EntityManagerInterface::class);
        $this->repository = $this->prophesize(ObjectRepository::class);
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
}
