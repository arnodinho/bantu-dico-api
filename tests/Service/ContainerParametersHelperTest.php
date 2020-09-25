<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 25/09/2020
 * Time: 14:25.
 */

namespace App\Tests\Service;

use App\Service\ContainerParametersHelper;
use Prophecy\Prophecy\ObjectProphecy;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ContainerParametersHelperTest extends TestCase
{
    protected ContainerParametersHelper $containerParametersHelper;

    private ObjectProphecy $params;

    protected function setUp(): void
    {
        $this->params = $this->prophesize(ParameterBagInterface::class);

        $this->containerParametersHelper = new ContainerParametersHelper(
            $this->params->reveal()
        );
    }

    public function testGetParameter()
    {
        $this->params->get(Argument::any())->shouldBeCalledOnce()->willReturn('BOO');

        $this->assertEquals(
            'BOO',
            $this->containerParametersHelper->getParameter('BOO')
        );
    }

    public function testGetApplicationRootDir()
    {
    }
}
