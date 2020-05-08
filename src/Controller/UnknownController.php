<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 17/02/2020
 * Time: 20:12.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Unknown;
use App\Form\UnknownType;
use App\Handler\UnknownHandler;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UnknownController.
 */
class UnknownController extends BaseController
{
    /**
     * @Route("/unknown/{id}", methods={"GET"})
     * @SWG\Get(
     *   tags={"unknown word"},
     *   summary="Get Unknown Word By it's Id.",
     *   description="This section retrive a unknown word by it's id given in url path",
     *   produces={"application/json"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *     @Model(type=Unknown::class)
     *   )
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_OK)
     */
    public function getUnknownAction(int $id, UnknownHandler $unknownHandler): ?Unknown
    {
        return $unknownHandler->retrieveById($id);
    }

    /**
     * @Route("/unknowns", methods={"GET"})
     * @SWG\Get(
     *   tags={"unknown word"},
     *   summary="Retrieve all unknown words in database",
     *   description="This section retrieve all unknown words in database",
     *   produces={"application/json"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref=@Model(type=Unknown::class)
     * )
     *         ),
     *   )
     * )
     *
     * @return Unknown[]|null
     * @Rest\View(statusCode=Response::HTTP_OK)
     */
    public function getUnknownsAction(UnknownHandler $unknownHandler): ?array
    {
        return $unknownHandler->retrieveAll();
    }

    /**
     * @Route("/unknown", methods={"POST"})
     * @SWG\Post(
     *   tags={"unknown word"},
     *   summary="unknown word creation",
     *   description="unknown word creation",
     *   consumes={"application/json"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="word payload",
     *     required=true,
     *     @Model(type=Unknown::class)
     *   ),
     *   @SWG\Response(
     *     response=Response::HTTP_CREATED,
     *     description=BaseController::MESG_SUCCESSFULL_OPERATION
     *   ),
     *   @SWG\Response(response=Response::HTTP_BAD_REQUEST, description="Bad Request")
     * )
     *
     * @return View
     */
    public function postUnknownAction(Request $request, UnknownHandler $unknownHandler)
    {
        $code = Response::HTTP_CREATED;
        $message = self::MESG_SUCCESSFULL_OPERATION;
        $unknown = new Unknown();

        $form = $this->createForm(UnknownType::class, $unknown);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            $code = Response::HTTP_CREATED;
            $message = Response::$statusTexts[Response::HTTP_BAD_REQUEST];
        }

        $unknownHandler->create($unknown);

        return $this->sendMessage($code, $message);
    }
}
