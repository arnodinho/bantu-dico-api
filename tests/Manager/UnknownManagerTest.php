<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 18:29.
 */

namespace App\Tests\Manager;

use App\Entity\Unknown;
use App\Manager\UnknownManager;
use App\Tests\AbstractManagerTest;
use Doctrine\Persistence\ObjectRepository;
use Prophecy\Argument;

class UnknownManagerTest extends AbstractManagerTest
{
    /**
     * @var UnknownManager
     */
    protected UnknownManager $unknownManager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->prophesize(ObjectRepository::class);
        $this->mockRepository(Unknown::class);
        $this->unknownManager = new UnknownManager($this->em->reveal());
    }

    public function testFindById(): void
    {
        $this->mockFindById($this->unknownModel);
        $this->assertEquals(
            $this->unknownModel,
            $this->unknownManager->findById($this->unknownModel->getId())
        );
    }

    public function testFindAll(): void
    {
        $this->mockFindAll([$this->unknownModel]);
        $this->assertEquals(
            [$this->unknownModel],
            $this->unknownManager->findAll()
        );
    }

    public function testSave(): void
    {
        $this->em
            ->persist(Argument::is($this->unknownModel))
            ->shouldBeCalledOnce();
        $this->em->flush()->shouldBeCalledOnce();

        $this->assertNull(
            $this->unknownManager->save($this->unknownModel)
        );
    }
}
