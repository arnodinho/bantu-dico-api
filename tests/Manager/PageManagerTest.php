<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 18:29.
 */

namespace App\Tests\Manager;

use App\Entity\Page;
use App\Manager\PageManager;
use App\Tests\AbstractManagerTest;

use Prophecy\Argument;

class PageManagerTest extends AbstractManagerTest
{
    /**
     * @var PageManager
     */
    protected $pageManager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockRepository(Page::class);
        $this->pageManager = new PageManager($this->em->reveal());
    }

    public function testFindById():void
    {
        $this->repository->find(
            Argument::is($this->pageModel->getId())
        )
            ->shouldBeCalledOnce()
            ->willReturn($this->pageModel);

        $this->assertEquals(
            $this->pageModel,
            $this->pageManager->findById($this->pageModel->getId())
        );
    }
}
