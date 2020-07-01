<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 17/02/2020
 * Time: 20:12.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Entity\French;
use App\Form\FrenchType;
use App\Handler\FrenchHandler;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FrenchController.
 */
class FrenchController extends BaseController
{
    /**
     * @Route("/french/{id}", methods={"GET"})
     * @SWG\Get(
     *   tags={"French"},
     *   summary="Get French By it's Id.",
     *   description="This section retrive a french by it's id given in url path",
     *   produces={"application/json"},
     *   @SWG\Response(
     *     response=Response::HTTP_CREATED,
     *     description="successful operation",
     *     @Model(type=French::class)
     *   )
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @param int $id
     * @param FrenchHandler $frenchHandler
     * @return French|null
     */
    public function getFrenchAction(int $id, FrenchHandler $frenchHandler): ?French
    {
        return $frenchHandler->retrieveById($id);
    }

    /**
     * @Route("/frenchs", methods={"GET"})
     * @SWG\Get(
     *   tags={"French"},
     *   summary="Retrieve all frenchs in database",
     *   description="This section retrieve all frenchs in database",
     *   produces={"application/json"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref=@Model(type=French::class)
     * )
     *         ),
     *   )
     * )
     *
     * @return French[]|null
     * @Rest\View(statusCode=Response::HTTP_OK)
     */
    public function getFrenchsAction(FrenchHandler $frenchHandler): ?array
    {
        return $frenchHandler->retrieveAll();
    }

    /**
     * @Route("/french", methods={"POST"})
     * @SWG\Post(
     *   tags={"French"},
     *   summary="French creation",
     *   description="French creation",
     *   consumes={"application/json"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Ffrench word creation",
     *     required=true,
     *     @Model(type=French::class)
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
    public function postFrenchAction(Request $request, FrenchHandler $frenchHandler)
    {
        $code = Response::HTTP_CREATED;
        $message = self::MESG_SUCCESSFULL_OPERATION;
        $french = new French();

        $form = $this->createForm(FrenchType::class, $french);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            $code = Response::HTTP_CREATED;
            $message = Response::$statusTexts[Response::HTTP_BAD_REQUEST];
        }

        $frenchHandler->create($french);

        return $this->sendMessage($code, $message);
    }

    /**
     * @Route("/french/{id}", methods={"DELETE"}, requirements={"id": "\d+"})
     * @SWG\Delete(
     *   tags={"French"},
     *   summary="Delete French By it's Id.",
     *   description="This section delete a french by it's id given in url path",
     *   produces={"application/json"},
     *   @SWG\Response(
     *     response=Response::HTTP_NO_CONTENT,
     *     description="successful operation"
     *   )
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @param int $id
     * @param FrenchHandler $frenchHandler
     */
    public function deleteFrenchAction(int $id, FrenchHandler $frenchHandler): void
    {
        $frenchHandler->deleteById($id);
    }

    /**
     * @Route("/french/{id}", methods={"PUT"}, requirements={"id": "\d+"})
     * @SWG\Put(
     *   tags={"French"},
     *   summary="French update",
     *   description="French update french by it's id",
     *   consumes={"application/json"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="french body",
     *     required=true,
     *     @SWG\Schema(
     *              @SWG\Property(
     *                  property="word",
     *                  type="string",
     *                  maximum=255
     *              ),
     *              @SWG\Property(
     *                  property="Description",
     *                  type="string",
     *                  maximum=255
     *              ),
     *              @SWG\Property(
     *                  property="Exemple",
     *                  type="string",
     *                  maximum=255
     *              ),
     *              @SWG\Property(
     *                  property="Url",
     *                  type="string",
     *                  maximum=255
     *              ),
     *              @SWG\Property(
     *                  property="Type",
     *                  type="string",
     *                  enum={
     *                      "nom",
     *                      "Pronom",
     *                      "adjectif",
     *                      "verbe",
     *                      "préposition",
     *                      "conjonction",
     *                      "Adjectif numéral",
     *                      "Adjectif"
     *                  }
     *              ),
     *              @SWG\Property(
     *                  property="Language",
     *                  type="string",
     *                  enum={
     *                      "French",
     *                      "Sango",
     *                      "Lingala",
     *                  }
     *              ),
     *              @SWG\Property(
     *                  property="Status",
     *                  type="boolean"
     *              )
     *     )
     *   ),
     *   @SWG\Response(
     *     response=Response::HTTP_NO_CONTENT,
     *     description="successful operation"
     *   )
     * )
     *  @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     *
     * @param int $id
     * @param Request $request
     * @param FrenchHandler $frenchHandler
     */
    public function putFrenchAction(int $id, Request $request, FrenchHandler $frenchHandler): void
    {
        if ($french = $frenchHandler->retrieveById($id)) {

            $form = $this->createForm(FrenchType::class, $french);

            $form->submit($request->request->all());

            if ($form->isValid()) {
                $frenchHandler->update($french);
            }
        }
    }
}
