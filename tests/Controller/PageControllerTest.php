<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 06/04/2020
 * Time: 13:39.
 */

namespace App\Tests\Controller;

use App\Controller\PageController;
use App\Handler\PageHandler;
use App\Tests\AbstractTest;
use Prophecy\Argument;

class PageControllerTest extends AbstractControllerTest
{
    /**
     * @var PageController
     */
    protected PageController $pageController;

    /**
     * @var PageHandler
     */
    protected $pageHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pageHandler =  $this->prophesize(PageHandler::class);
        $this->pageController = new PageController();
    }

    public function testGetPageAction(): void
    {
        $this->mockRetrieveById($this->pageHandler, $this->pageModel);
        $this->assertEquals(
            $this->pageModel,
            $this->pageController->getPageAction($this->pageModel->getId(), $this->pageHandler->reveal())
        );
    }

    public function testGetPagesAction(): void
    {
        $this->mockRetrieveAll($this->pageHandler, [$this->pageModel]);
        $this->assertEquals(
            [$this->pageModel],
            $this->pageController->getPagesAction($this->pageHandler->reveal())
        );
    }
}
