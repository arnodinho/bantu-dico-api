<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 28/03/2020
 * Time: 16:31.
 */

declare(strict_types=1);

namespace App\Tests\Handler;

use App\Entity\Page;
use App\Handler\PageHandler;
use App\Manager\PageManager;

use App\Tests\AbstractHandlerTest;
use Prophecy\Argument;

/**
 * Class PageHandlerTest
 * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
*/
class PageHandlerTest extends AbstractHandlerTest
{
    protected $pageManager;

    protected PageHandler $pageHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pageManager = $this->prophesize(PageManager::class);
        $this->pageHandler  = new PageHandler(
            $this->pageManager->reveal()
        );
    }

    public function testGetPageById(): void
    {
        $this->mockRetrieveEntity($this->pageManager, $this->pageModel);
        $this->assertEquals(
            $this->pageModel,
            $this->pageHandler->retrieveById($this->pageModel->getId())
        );
    }

    public function testGetPages(): void
    {
        $this->mockRetrieveEntitiesList($this->pageManager, [$this->pageModel]);
        $this->assertEquals(
            [$this->pageModel],
            $this->pageHandler->retrieveAll()
        );
    }
}
