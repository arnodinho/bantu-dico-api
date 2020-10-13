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
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * Class FrenchHandler.
 */
class FrenchHandler extends AbstractHandler implements HandlerInterface
{
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
                $this->frenchManager->search('id', $id),
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

    /**
     * @param int $id
     * @throws ExceptionInterface
     */
    public function deleteById(int $id)
    {
        if ($entity = $this->retrieveById($id)) {
            $this->frenchManager->delete($entity);
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
}
