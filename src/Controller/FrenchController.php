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
use GuzzleHttp\Exception\GuzzleException;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * Class FrenchController.
 */
class FrenchController extends BaseController
{
    public const INVALID_WORD = 'Invalid Word';

    /**
     * @Route("/french/{id}", methods={"GET"})
     * @OA\Get(
     *   tags={"French"},
     *   summary="Get French By it's Id.",
     *   description="This section retrive a french by it's id given in url path",
     *   @OA\Response(
     *     response=Response::HTTP_CREATED,
     *     description="successful operation",
     *     @Model(type=French::class)
     *   )
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_OK)
     *
     * @throws ExceptionInterface
     */
    public function getFrenchAction(int $id, FrenchHandler $frenchHandler): ?French
    {
        return $frenchHandler->retrieveById($id);
    }

    /**
     * @Route("/frenchs", methods={"GET"})
     * @OA\Get(
     *   tags={"French"},
     *   summary="Retrieve all frenchs in database",
     *   description="This section retrieve all frenchs in database",
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref=@Model(type=French::class)
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
     * @OA\Post(
     *   tags={"French"},
     *   summary="French Word creation",
     *   description="French creation",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                    @OA\Property(
     *                     property="word",
     *                     type="string",
     *                     maximum=255
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     maximum=255
     *                 ),
     *                 @OA\Property(
     *                     property="exemple",
     *                     type="string",
     *                     maximum=255
     *                 ),
     *                 @OA\Property(
     *                     property="url",
     *                     type="string",
     *                     maximum=255
     *                 ),
     *                 @OA\Property(
     *                     property="type",
     *                     type="string",
     *                     enum={
     *                         "nom",
     *                         "Pronom",
     *                         "adjectif",
     *                         "verbe",
     *                         "préposition",
     *                         "conjonction",
     *                         "Adjectif numéral",
     *                         "Adjectif"
     *                     }
     *                 ),
     *                 @OA\Property(
     *                     property="language",
     *                     type="string",
     *                     enum={
     *                         "French",
     *                         "Sango",
     *                         "Lingala",
     *                     }
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="checkValidity",
     *                     type="boolean"
     *                 )
     *              )
     *          )
     *     )
     *   ),
     *   @OA\Response(
     *     response=Response::HTTP_CREATED,
     *     description=BaseController::MESG_SUCCESSFULL_OPERATION
     *   ),
     *   @OA\Response(
     *     response=Response::HTTP_INTERNAL_SERVER_ERROR,
     *     description=FrenchController::INVALID_WORD
     *   ),
     *   @OA\Response(response=Response::HTTP_BAD_REQUEST, description="Bad Request")
     * )
     *
     * @return View
     *
     * @throws GuzzleException
     */
    public function postFrenchAction(Request $request, FrenchHandler $frenchHandler)
    {
        $french = new French();
        $payload = $request->request->all();
        $checkValidity = !empty($payload['checkValidity']) ? $payload['checkValidity']: false;
        unset($payload['checkValidity']);
        
        $form = $this->createForm(FrenchType::class, $french);
        $form->submit($payload);

        if (!$form->isValid()) {
            return $this->sendMessage(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                Response::$statusTexts[Response::HTTP_BAD_REQUEST]
            );
        }

        if ($checkValidity && !$frenchHandler->isWordValid($french->getWord())) {
            return $this->sendMessage(Response::HTTP_INTERNAL_SERVER_ERROR, self::INVALID_WORD);
        }

        $frenchHandler->create($french);

        return $this->sendMessage(Response::HTTP_CREATED, self::MESG_SUCCESSFULL_OPERATION);
    }

    /**
     * @Route("/french/search", methods={"POST"})
     * @OA\Post(
     *   tags={"French"},
     *   summary="search french by word or id",
     *   description="search french word or id",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="identifier",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="search",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *   @OA\Response(
     *     response=Response::HTTP_OK,
     *     description=BaseController::MESG_SUCCESSFULL_OPERATION,
     *     @Model(type=French::class)
     *   )
     * )
     * @Rest\View(statusCode=Response::HTTP_OK)
     *
     * @return French|mixed|null
     *
     * @throws ExceptionInterface
     */
    public function searchFrenchAction(Request $request, FrenchHandler $frenchHandler): ?French
    {
        $data = $request->request->all();

        return $frenchHandler->search($data['identifier'], $data['search']);
    }

    /**
     * @Route("/french/{id}", methods={"DELETE"}, requirements={"id": "\d+"})
     * @OA\Delete(
     *   tags={"French"},
     *   summary="Delete French By it's Id.",
     *   description="This section delete a french by it's id given in url path",
     *   @OA\Response(
     *     response=Response::HTTP_NO_CONTENT,
     *     description="successful operation"
     *   )
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     */
    public function deleteFrenchAction(French $french, FrenchHandler $frenchHandler): void
    {
        $frenchHandler->delete($french);
    }

    /**
     * @Route("/french/{id}", methods={"PUT"}, requirements={"id": "\d+"})
     * @OA\Put(
     *   tags={"French"},
     *   summary="French update",
     *   description="French update french by it's id",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                    @OA\Property(
     *                         property="word",
     *                         type="string",
     *                         maximum=255
     *                     ),
     *                    @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         maximum=255
     *                     ),
     *                    @OA\Property(
     *                         property="exemple",
     *                         type="string",
     *                         maximum=255
     *                     ),
     *                    @OA\Property(
     *                         property="url",
     *                         type="string",
     *                         maximum=255
     *                     ),
     *                    @OA\Property(
     *                         property="type",
     *                         type="string",
     *                         enum={
     *                             "nom",
     *                             "Pronom",
     *                             "adjectif",
     *                             "verbe",
     *                             "préposition",
     *                             "conjonction",
     *                             "Adjectif numéral",
     *                             "Adjectif"
     *                         }
     *                     ),
     *                    @OA\Property(
     *                         property="language",
     *                         type="string",
     *                         enum={
     *                             "French",
     *                             "Sango",
     *                             "Lingala",
     *                         }
     *                     ),
     *                    @OA\Property(
     *                         property="Status",
     *                         type="boolean"
     *                     )
     *                  )
     *            )
     *     )
     *   ),
     *  @OA\Response(
     *     response=Response::HTTP_NO_CONTENT,
     *     description="successful operation"
     *   )
     * )
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     *
     * @throws ExceptionInterface
     */
    public function putFrenchAction(Request $request, FrenchHandler $frenchHandler, French $french = null): void
    {
        if ($french) {
            $form = $this->createForm(FrenchType::class, $french);
            $form->submit($request->request->all());

            if ($form->isValid()) {
                $frenchHandler->update($french);
            }
        }
    }
}
