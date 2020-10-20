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
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use GuzzleHttp\Client;

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

    /**
     * @var ObjectProphecy
     */
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->serializer = $this->prophesize(Serializer::class);
        $this->serializerHandler = $this->prophesize(SerializerHandler::class);
        $this->client = $this->prophesize(Client::class);
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
     * @param string $identifier
     * @param $search
     * @param $entity
     */
    protected function mockSearch(string $identifier, $search, $entity): void
    {
        $this->manager->search(
            Argument::is($identifier),
            Argument::is($search)
        )
            ->shouldBeCalledOnce()
            ->willReturn($entity);
    }

    protected function mockGetSerializer()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializerHandler->getSerializer()
            ->shouldBeCalledOnce()
            ->willReturn(new Serializer($normalizers, $encoders));
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
     * @param array $entity
     */
    protected function mockRetrieveEntityBySearchId(int $id, array $entity): void
    {
        $this->manager->search(
            Argument::is($id)
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
