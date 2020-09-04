<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:39.
 */

declare(strict_types=1);

namespace App\Handler;

use App\Entity\French;
use App\Entity\StorableEntityInterface;
use App\Manager\FrenchManager;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * Class FrenchHandler.
 */
class FrenchHandler extends AbstractHandler implements HandlerInterface
{
    public const URL_YANDEX = 'https://dictionary.yandex.net/api/v1/dicservice.json/lookup';

    /**
     * @var FrenchManager
     */
    protected FrenchManager $frenchManager;

    /**
     * FrenchHandler constructor.
     * @param FrenchManager $frenchManager
     */
    public function __construct(FrenchManager $frenchManager)
    {
        parent::__construct();
        $this->frenchManager = $frenchManager;
    }

    /**
     * @param int $id
     * @return French|null|mixed
     * @throws ExceptionInterface
     */
    public function retrieveById(int $id)
    {
        return $this->serializerHandler
            ->getSerializer()
            ->denormalize(
                $this->frenchManager->findById($id),
                French::class
            );
    }

    /**
     * @return array|null
     */
    public function retrieveAll(): ?array
    {
        return $this->frenchManager->findAll();
    }

    /**
     * @param StorableEntityInterface $entity
     */
    public function create(StorableEntityInterface $entity): void
    {
        $this->frenchManager->save($entity);
    }

    public function deleteById(int $id)
    {
        try {
            if ($entity = $this->retrieveById($id)) {
                $this->frenchManager->delete($entity);
            }
        } catch (ExceptionInterface $e) {
        }
    }

    public function update(StorableEntityInterface $entity):void
    {
        $this->frenchManager->save($entity);
    }

    /**
     * @param string $identifier
     * @param string $search
     * @return French|null|mixed
     * @throws ExceptionInterface
     */
    public function search(string $identifier, string $search): ?French
    {
        return $this->serializerHandler
            ->getSerializer()
            ->denormalize(
                $this->frenchManager->search($identifier, $search),
                French::class
            );
    }

    /**
     * Check if word exists in french dictionary.
     *
     * @param string $word
     * @return bool
     * @throws GuzzleException
     */
    public function isWordValid(string $word): bool
    {
        $response = $this->client
            ->request('GET', self::URL_YANDEX, [
                'query' => [
                    'key' => $_ENV['YANDEX_API_KEY'],
                    'lang' => 'fr-fr',
                    'text' => $word
                ]
            ]);

        if (Response::HTTP_OK !== $response->getStatusCode()) {
            return false;
        }

        $result = json_decode($response->getBody()->getContents());

        if (empty($result->def)) {
            return false;
        }

        return true;
    }
}
