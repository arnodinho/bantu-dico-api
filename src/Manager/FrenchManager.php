<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:56.
 */

declare(strict_types=1);

namespace App\Manager;

use App\Entity\French;
use App\Repository\FrenchRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class FrenchManager.
 */
class FrenchManager extends AbstractManager implements ManagerInterface
{
    /**
     * @var FrenchRepository
     */
    protected $repository;

    /**
     * FrenchManager constructor.
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->repository = $this->getEntityManager()->getRepository(French::class);
    }

    /**
     * @param int $id
     * @return French|null
     */
    public function findById(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * @return French[]|object[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
