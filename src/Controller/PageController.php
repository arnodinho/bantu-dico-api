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
     * Get Page By it's Id.
     *
     * @Route("/page/{id}", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="return page Entity",
     *     @Model(type=Page::class)
     * )
     * @param int $id
     * @param PageHandler $pageHandler
     *
     * @return Page|null
     * @Rest\View(statusCode=Response::HTTP_OK)
     */
    public function getPageAction(int $id, PageHandler $pageHandler): ?Page
    {
        return $pageHandler->getPageById($id);
    }
}
