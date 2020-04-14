<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 17/02/2020
 * Time: 20:12.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Form\PageType;
use App\Handler\PageHandler;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Page;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class PageController.
 */
class PageController extends BaseController
{
    /**
     * @Route("/page/{id}", methods={"GET"})
     * @SWG\Get(
     *   tags={"page"},
     *   summary="Get Page By it's Id.",
     *   description="This section retrive a page by it's id given in url path",
     *   produces={"application/json"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *     @Model(type=Page::class)
     *   )
     * )
     * @param int $id
     * @param PageHandler $pageHandler
     *
     * @return Page|null
     * @Rest\View(statusCode=Response::HTTP_OK)
     */
    public function getPageAction(int $id, PageHandler $pageHandler): ?Page
    {
        return $pageHandler->retrieveById($id);
    }

    /**
     * @Route("/pages", methods={"GET"})
     * @SWG\Get(
     *   tags={"page"},
     *   summary="Retrieve all pages in database",
     *   description="This section retrieve all pages in database",
     *   produces={"application/json"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref=@Model(type=Page::class)
     * )
     *         ),
     *   )
     * )
     * @param PageHandler $pageHandler
     *
     * @return Page[]|null
     * @Rest\View(statusCode=Response::HTTP_OK)
     */
    public function getPagesAction(PageHandler $pageHandler): ?array
    {
        return $pageHandler->retrieveAll();
    }

    /**
     * @Route("/page", methods={"POST"})
     * @SWG\Post(
     *   tags={"page"},
     *   summary="Page creation",
     *   description="Page creation",
     *   consumes={"application/json"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="order placed for purchasing the pet",
     *     required=true,
     *     @Model(type=Page::class)
     *   ),
     *   @SWG\Response(
     *     response=Response::HTTP_CREATED,
     *     description=BaseController::MESG_SUCCESSFULL_OPERATION,
     *     @SWG\Schema(ref=@Model(type=Page::class))
     *   ),
     *   @SWG\Response(response=Response::HTTP_BAD_REQUEST, description="Bad Request")
     * )
     * @param Request $request
     * @param PageHandler $pageHandler
     * @return View
     */
    public function postPageAction(Request $request, PageHandler $pageHandler)
    {
        $code       = Response::HTTP_CREATED;
        $message    = self::MESG_SUCCESSFULL_OPERATION;
        $page = new Page();

        $form = $this->createForm(PageType::class, $page);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            $code       = Response::HTTP_CREATED;
            $message    = Response::$statusTexts[Response::HTTP_BAD_REQUEST];
        }

        $pageHandler->create($page);

        return $this->sendMessage($code, $message);
    }
}
