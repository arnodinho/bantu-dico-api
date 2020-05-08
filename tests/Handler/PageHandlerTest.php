<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 28/03/2020
 * Time: 16:31.
 */

declare(strict_types=1);

namespace App\Tests\Handler;

use App\Handler\PageHandler;
use App\Manager\PageManager;

use App\Tests\AbstractHandlerTest;

/**
 * Class PageHandlerTest
 * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
*/
class PageHandlerTest extends AbstractHandlerTest
{
    protected PageHandler $pageHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = $this->prophesize(PageManager::class);
        $this->pageHandler  = new PageHandler(
            $this->manager->reveal()
        );
    }

    public function testGetPageById(): void
    {
        $this->mockRetrieveEntity($this->pageModel);
        $this->assertEquals(
            $this->pageModel,
            $this->pageHandler->retrieveById($this->pageModel->getId())
        );
    }

    public function testGetPages(): void
    {
        $this->mockRetrieveEntitiesList([$this->pageModel]);
        $this->assertEquals(
            [$this->pageModel],
            $this->pageHandler->retrieveAll()
        );
    }


    public function testCreate(): void
    {
        $this->mockManagerSave($this->pageModel);
        $this->assertNull(
            $this->pageHandler->create($this->pageModel)
        );
    }
}
