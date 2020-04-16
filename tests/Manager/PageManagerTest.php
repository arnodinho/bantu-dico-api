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

    public function testFindById(): void
    {
        $this->mockFindById($this->pageModel);
        $this->assertEquals(
            $this->pageModel,
            $this->pageManager->findById($this->pageModel->getId())
        );
    }

    public function testFindAll(): void
    {
        $this->mockFindAll([$this->pageModel]);
        $this->assertEquals(
            [$this->pageModel],
            $this->pageManager->findAll()
        );
    }

    public function testSave(): void
    {
        $this->em
            ->persist(Argument::is($this->pageModel))
            ->shouldBeCalledOnce();
        $this->em->flush()->shouldBeCalledOnce();

        $this->assertNull(
            $this->pageManager->save($this->pageModel)
        );
    }
}
