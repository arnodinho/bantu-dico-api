<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 20:44.
 */

namespace App\Tests;

use App\Entity\StorableEntityInterface;
use App\Manager\ManagerInterface;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class AbstractHandlerTest.
 */
class AbstractHandlerTest extends AbstractTest
{
    /**
     * @var ObjectProphecy
     */
    protected ObjectProphecy $manager;

    protected function setUp(): void
    {
        parent::setUp();
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
     * @param int $id
     * @param StorableEntityInterface $entity
     */
    protected function mockRetrieveEntityById(int $id, StorableEntityInterface $entity): void
    {
        $this->manager->findById(
            Argument::is($id)
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
