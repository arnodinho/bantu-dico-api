<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 28/03/2020
 * Time: 16:31.
 */

declare(strict_types=1);

namespace App\Tests\Handler;

use App\Handler\UnknownHandler;
use App\Manager\UnknownManager;
use App\Tests\AbstractHandlerTest;

/**
 * Class UnknownHandlerTest
 *
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
*/
class UnknownHandlerTest extends AbstractHandlerTest
{
    protected UnknownHandler $unknownHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = $this->prophesize(UnknownManager::class);
        $this->unknownHandler  = new UnknownHandler(
            $this->manager->reveal()
        );
    }

    public function testGetUnknownById(): void
    {
        $this->mockRetrieveEntity($this->unknownModel);
        $this->assertEquals(
            $this->unknownModel,
            $this->unknownHandler->retrieveById($this->unknownModel->getId())
        );
    }

    public function testGetUnknowns(): void
    {
        $this->mockRetrieveEntitiesList([$this->unknownModel]);
        $this->assertEquals(
            [$this->unknownModel],
            $this->unknownHandler->retrieveAll()
        );
    }

    public function testCreate(): void
    {
        $this->mockManagerSave($this->unknownModel);
        $this->assertNull(
            $this->unknownHandler->create($this->unknownModel)
        );
    }

    public function testDeleteById(): void
    {
        $this->mockRetrieveEntityById($this->unknownModel->getId(), $this->unknownModel);
        $this->mockDeleteEntity($this->unknownModel);

        $this->assertNull(
            $this->unknownHandler->deleteById($this->unknownModel->getId())
        );
    }
}
