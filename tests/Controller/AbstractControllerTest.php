<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 06/04/2020
 * Time: 13:39.
 */

namespace App\Tests\Controller;

use App\Entity\Page;
use App\Entity\Unknown;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class AbstractControllerTest.
 */
class AbstractControllerTest extends TypeTestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    protected Page $pageModel;

    protected Unknown $unknownModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pageModel = (new Page())
            ->setId(5)
            ->setTitle('title Mock Pock')
            ->setLanguage('FR')
            ->setContent('atzsjsd sukdgskudhqs skdh sdfksdh  sdifhsd');

        $this->unknownModel = (new Unknown())
            ->setId(5)
            ->setWord('title unknown Pock')
            ->setSource('French')
            ->setTarget('Sango')
            ->setOrigin('app');
    }

    protected function initContainer()
    {
        if (null === $this->container) {
            $this->container = new ContainerBuilder();
        }
    }

    /**
     * @param $service
     */
    public function mockContainer(string $key, $service)
    {
        $this->initContainer();
        $this->container->set($key, $service);
    }

    /**
     * @param $model
     */
    protected function mockRetrieveById(ObjectProphecy $handler, $model): void
    {
        $handler->retrieveById(
            Argument::is($model->getId())
        )
            ->shouldBeCalledOnce()
            ->willReturn($model);
    }

    protected function mockRetrieveAll(ObjectProphecy $handler, array $modelTab): void
    {
        $handler->retrieveAll()
            ->shouldBeCalledOnce()
            ->willReturn($modelTab);
    }
}
