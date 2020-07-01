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
        $this->frenchManager = $frenchManager;
    }

    /**
     * @param int $id
     * @return French|null
     */
    public function retrieveById(int $id)
    {
        return $this->frenchManager->findById($id);
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
        if ($entity = $this->frenchManager->findById($id)) {
            $this->frenchManager->delete($entity);
        }
    }

    public function update(StorableEntityInterface $entity):void
    {
        $this->frenchManager->save($entity);
    }
}
