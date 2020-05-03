<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 06/04/2020
 * Time: 13:39.
 */

namespace App\Tests\Controller;

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

    protected function setUp(): void
    {
        parent::setUp();
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
