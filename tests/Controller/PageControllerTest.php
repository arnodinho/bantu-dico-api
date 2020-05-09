<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 06/04/2020
 * Time: 13:39.
 */

namespace App\Tests\Controller;

use App\Controller\PageController;
use App\Entity\Page;
use App\Handler\PageHandler;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class PageControllerTest extends AbstractControllerTest
{
    /**
     * @var PageController
     */
    protected PageController $pageController;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var PageHandler
     */
    protected $pageHandler;

    /**
     * @var ObjectProphecy
     */
    protected ObjectProphecy $form;

    protected array $payload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formFactory =  $this->prophesize(FormFactory::class);
        $this->form = $this->prophesize(Form::class);

        $this->pageHandler =  $this->prophesize(PageHandler::class);
        $this->payload =  [
            "title" => "title page - 1250",
            "language" => "French",
            "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor"
        ];

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

    public function testpostPageAction(): void
    {
        $request = new Request();
        $request->request->add($this->payload);

        $form = $this->getMockBuilder(FormInterface::class)->getMock();
        $form->expects($this->once())->method('submit');

        $formFactory = $this->getMockBuilder(FormFactoryInterface::class)->getMock();
        $formFactory->expects($this->once())->method('create')->will($this->returnValue($form));

        $pageHandler = $this->getMockBuilder(PageHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $pageHandler->expects($this->once())->method('create');

        $this->mockContainer('form.factory', $formFactory);
        $this->pageController->setContainer($this->container);

        $this->pageController->postPageAction($request, $pageHandler);
    }

    public function testDeletePageAction(): void
    {
        $this->pageHandler->deleteById(
            Argument::is($this->pageModel->getId())
        )
            ->shouldBeCalledOnce();

        $this->assertNull(
            $this->pageController->deletePageAction($this->pageModel->getId(), $this->pageHandler->reveal())
        );
    }
}
