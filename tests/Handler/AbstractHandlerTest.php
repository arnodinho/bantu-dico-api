<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 20:44.
 */

namespace App\Tests;

use App\Entity\StorableEntityInterface;
use App\Serializer\SerializerHandler;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Serializer\Serializer;

/**
 * Class AbstractHandlerTest.
 */
class AbstractHandlerTest extends AbstractTest
{
    protected ObjectProphecy $manager;

    /**
     * @var ObjectProphecy
     */
    protected $serializerHandler;

    /**
     * @var ObjectProphecy
     */
    protected $serializer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->serializer = $this->prophesize(Serializer::class);
        $this->serializerHandler = $this->prophesize(SerializerHandler::class);
    }

    /**
     * @param StorableEntityInterface $entity
     */
    protected function mockRetrieveEntity(StorableEntityInterface $entity): void
    {
        $this->manager->findById(
            Argument::type('integer')
        )
            ->shouldBeCalledOnce()
            ->willReturn($entity);
    }

    /**
     * @param array $entity
     */
    protected function mockSearch(string $identifier, string $search, $entity): void
    {
        $this->manager->search(
            Argument::is($identifier),
            Argument::is($search)
        )
            ->shouldBeCalledOnce()
            ->willReturn($entity);
    }

    /**
     * @param ObjectProphecy $manager
     * @param array $modelTab
     */
    protected function mockRetrieveEntitiesList(array $modelTab): void
    {
        $this->manager->findAll()
            ->shouldBeCalledOnce()
            ->willReturn($modelTab);
    }

    /**
     * @param StorableEntityInterface $entity
     */
    protected function mockManagerSave(StorableEntityInterface $entity): void
    {
        $this->manager
            ->save(Argument::exact($entity))
            ->shouldBeCalledOnce();
    }

    /**
     * @param array $entity
     */
    protected function mockRetrieveEntityArray(array $entity): void
    {
        $this->manager->findById(
            Argument::type('integer')
        )
            ->shouldBeCalledOnce()
            ->willReturn($entity);
    }

    /**
     * @param  $id
     * @param StorableEntityInterface|array $entity
     */
    protected function mockRetrieveEntityById(int $id, $entity): void
    {
        $this->manager->findById(
            Argument::is($id)
        )
            ->shouldBeCalledOnce()
            ->willReturn($entity);
    }

    /**
     * @param string $className
     * @param array $dataFormatted
     * @param StorableEntityInterface $entity
     */
    protected function mockRetrieveEntityDenormalized(
        string $className,
        array $dataFormatted,
        StorableEntityInterface $entity
    ): void {
        $this->serializer->denormalize(
            Argument::is($dataFormatted),
            Argument::is($className)
        )
            ->shouldBeCalledOnce()
            ->willReturn($entity);
    }

    /**
     * @param StorableEntityInterface $entity
     */
    protected function mockDeleteEntity(StorableEntityInterface $entity): void
    {
        $this->manager->delete(Argument::is($entity))->shouldBeCalledOnce();
    }
}
