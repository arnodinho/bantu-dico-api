<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:39.
 */

declare(strict_types=1);

namespace App\Handler;

use App\Entity\StorableEntityInterface;
use App\Entity\Unknown;
use App\Manager\UnknownManager;
use App\Serializer\SerializerHandler;
use GuzzleHttp\Client;

/**
 * Class UnknownHandler.
 */
class UnknownHandler extends AbstractHandler implements HandlerInterface
{
    protected UnknownManager $unknownManager;

    /**
     * UnknownHandler constructor.
     */
    public function __construct(
        UnknownManager $unknownManager,
        SerializerHandler $serializerHandler,
        Client $client
    ) {
        parent::__construct($serializerHandler, $client);
        $this->unknownManager = $unknownManager;
    }

    /**
     * @return Unknown|null
     */
    public function retrieveById(int $id)
    {
        return $this->unknownManager->findById($id);
    }

    public function retrieveAll(): ?array
    {
        return $this->unknownManager->findAll();
    }

    public function create(StorableEntityInterface $entity): void
    {
        $this->unknownManager->save($entity);
    }

    public function delete(StorableEntityInterface $entity)
    {
        $this->unknownManager->delete($entity);
    }

    public function update(StorableEntityInterface $entity): void
    {
        $this->unknownManager->save($entity);
    }
}
