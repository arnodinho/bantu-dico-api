<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 06/04/2020
 * Time: 13:39.
 */

namespace App\Tests\Controller;

use App\Controller\UnknownController;
use App\Entity\Unknown;
use App\Handler\UnknownHandler;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class UnknownControllerTest extends AbstractControllerTest
{
    /**
     * @var UnknownController
     */
    protected UnknownController $unknownController;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var UnknownHandler
     */
    protected $unknownHandler;

    /**
     * @var ObjectProphecy
     */
    protected ObjectProphecy $form;

    protected array $payload;

    protected Unknown $unknownModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formFactory =  $this->prophesize(FormFactory::class);
        $this->form = $this->prophesize(Form::class);

        $this->unknownHandler =  $this->prophesize(UnknownHandler::class);
        $this->payload =  [
            "word" => "unknown word xz",
            "source" => "french",
            "target"=> "Lingala",
            "origin"=> "app"
        ];

        $this->unknownController = new UnknownController();
    }

    public function testGetUnknownAction(): void
    {
        $this->mockRetrieveById($this->unknownHandler, $this->unknownModel);
        $this->assertEquals(
            $this->unknownModel,
            $this->unknownController->getUnknownAction($this->unknownModel->getId(), $this->unknownHandler->reveal())
        );
    }

    public function testGetUnknownsAction(): void
    {
        $this->mockRetrieveAll($this->unknownHandler, [$this->unknownModel]);
        $this->assertEquals(
            [$this->unknownModel],
            $this->unknownController->getUnknownsAction($this->unknownHandler->reveal())
        );
    }

    public function testpostUnknownAction(): void
    {
        $request = new Request();
        $request->request->add($this->payload);

        $form = $this->getMockBuilder(FormInterface::class)->getMock();
        $form->expects($this->once())->method('submit');

        $formFactory = $this->getMockBuilder(FormFactoryInterface::class)->getMock();
        $formFactory->expects($this->once())->method('create')->will($this->returnValue($form));

        $unknownHandler = $this->getMockBuilder(UnknownHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $unknownHandler->expects($this->once())->method('create');

        $this->mockContainer('form.factory', $formFactory);
        $this->unknownController->setContainer($this->container);

        $this->unknownController->postUnknownAction($request, $unknownHandler);
    }

    public function testDeleteUnknownAction(): void
    {
        $this->unknownHandler->deleteById(
            Argument::is($this->unknownModel->getId())
        )
            ->shouldBeCalledOnce();

        $this->assertNull(
            $this->unknownController->deleteUnknownAction($this->unknownModel->getId(), $this->unknownHandler->reveal())
        );
    }
}
