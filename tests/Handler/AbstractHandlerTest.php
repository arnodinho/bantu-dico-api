<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 20:44.
 */

namespace App\Tests;

use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class AbstractHandlerTest.
 */
class AbstractHandlerTest extends AbstractTest
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param ObjectProphecy $manager
     * @param $model
     */
    protected function mockRetrieveEntity(ObjectProphecy $manager, $model): void
    {
        $manager->findById(
            Argument::type('integer')
        )
            ->shouldBeCalledOnce()
            ->willReturn($model);
    }

    /**
     * @param ObjectProphecy $manager
     * @param array $modelTab
     */
    protected function mockRetrieveEntitiesList(ObjectProphecy $manager, array $modelTab): void
    {
        $manager->findAll()
            ->shouldBeCalledOnce()
            ->willReturn($modelTab);
    }
}
