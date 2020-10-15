<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 18:29.
 */

namespace App\Tests\Manager;

use App\Cache\RedisCache;
use App\Entity\Page;
use App\Manager\PageManager;
use App\Repository\PageRepository;
use App\Tests\AbstractManagerTest;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class PageManagerTest extends AbstractManagerTest
{
    /**
     * @var PageManager
     */
    protected $pageManager;


    /**
     * @var ObjectProphecy
     */
    protected $redis;
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->prophesize(PageRepository::class);
        $this->redis = $this->prophesize(RedisCache::class);
        $this->mockRepository(Page::class);

        $this->pageManager = new PageManager($this->em->reveal(), $this->redis->reveal());
    }

    /**
     * @dataProvider pageProvider
     * @param Page|null $page
     */
    public function testFindById(?Page $page): void
    {
        $this->mockFindByIdWithRedis($this->pageModel->getId(), $page);

        if (!$page) {
            $this->mockFindById($this->pageModel->getId(), $this->pageModel);
            $this->mockRedisSetData(
                $this->pageModel->getId(),
                $this->pageModel,
                PageManager::REDIS_PAGE_NAMESPACE
            );
        }
        
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

    public function testDelete(): void
    {
        $this->em
            ->remove(Argument::is($this->pageModel))
            ->shouldBeCalledOnce();
        $this->em->flush()->shouldBeCalledOnce();

        $this->assertNull(
            $this->pageManager->delete($this->pageModel)
        );
    }

    public function pageProvider(): array
    {
        return [
            [
                (new Page())->setId(6)
                ->setTitle('title page - 5')
                ->setLanguage('French')
                ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor')
                ->setCreatedAt(new \DateTime('2020-04-15 10:11:28'))
                ->setUpdatedAt(new \DateTime('2020-04-15 10:11:28'))
            ],
            [null]
        ];
    }
}
