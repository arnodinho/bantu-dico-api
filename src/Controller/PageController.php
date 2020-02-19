<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 17/02/2020
 * Time: 20:12.
 */

declare(strict_types=1);

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
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
     *     description="Get Page By it's Id.",
     *     @Model(type=Page::class)
     * )
     * @param Request $request
     * @return Response
     */
    public function getPageAction(Request $request)
    {

        return new Response('aaa');
    }
}
