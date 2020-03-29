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
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class PageHandlerTest
 * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
*/
class PageHandlerTest extends TestCase
{
    protected $pageManager;

    protected PageHandler $pageHandler;

    /**
     * @var Page|ObjectProphecy
     */
    protected $pageModel;

    protected function setUp(): void
    {
        $this->pageModel = (new Page())
            ->setId(5)
            ->setTitle('title Mock Pock')
            ->setLanguage('FR')
            ->setContent('atzsjsd sukdgskudhqs skdh sdfksdh  sdifhsd')
            ->setCreatedAt(new \DateTime('now'))
            ->setUpdatedAt(new \DateTime('now'));

        $this->pageManager = $this->prophesize(PageManager::class);
        $this->pageHandler  = new PageHandler(
            $this->pageManager->reveal()
        );
    }

    public function testGetPageById(): void
    {
        $this->mockRetrievePage($this->pageModel);
        $this->assertEquals(
            $this->pageModel,
            $this->pageHandler->retrievePageById($this->pageModel->getId())
        );
    }

    private function mockRetrievePage($pageModel): void
    {
        $this->pageManager->findById(
            Argument::type('integer')
        )
            ->shouldBeCalledOnce()
            ->willReturn($pageModel);
    }
}
