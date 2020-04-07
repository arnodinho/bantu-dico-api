<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 17/02/2020
 * Time: 20:12.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Handler\PageHandler;
use FOS\RestBundle\Controller\Annotations\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Page;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class PageController.
 */
class PageController
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
        return $pageHandler->retrievePageById($id);
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
     *             @SWG\Items(
     *                  type="object",
     *                  @SWG\Property(property="id",        type="integer"),
     *                  @SWG\Property(property="title",     type="string"),
     *                  @SWG\Property(property="language",  type="string"),
     *                  @SWG\Property(property="content",   type="string"),
     *                  @SWG\Property(property="createdAt", type="string", format="date-time"),
     *                  @SWG\Property(property="updatedAt", type="string",format="date-time")
     * )
     *         ),
     *   )
     * )
     * @param PageHandler $pageHandler
     *
     * @return Page[]|null
     * @Rest\View(statusCode=Response::HTTP_OK)
     */
    public function getPagesAction(PageHandler $pageHandler): ? array
    {
        return $pageHandler->retrievePages();
    }
}
