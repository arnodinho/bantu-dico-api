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
use App\Manager\PageManager;
use App\Serializer\SerializerHandler;
use GuzzleHttp\Client;

/**
 * Class PageHandler.
 */
class PageHandler extends AbstractHandler implements HandlerInterface
{
    protected PageManager $pageManager;

    /**
     * PageHandler constructor.
     */
    public function __construct(
        PageManager $pageManager,
        SerializerHandler $serializerHandler,
        Client $client
    ) {
        parent::__construct($serializerHandler, $client);
        $this->pageManager = $pageManager;
    }

    /**
     * @return StorableEntityInterface|bool
     */
    public function retrieveById(int $id)
    {
        return $this->pageManager->findById($id);
    }

    public function retrieveAll(): ?array
    {
        return $this->pageManager->findAll();
    }

    public function create(StorableEntityInterface $entity): void
    {
        $this->pageManager->save($entity);
    }

    public function delete(StorableEntityInterface $entity)
    {
        $this->pageManager->delete($entity);
    }

    public function update(StorableEntityInterface $entity): void
    {
        $this->pageManager->save($entity);
    }
}
