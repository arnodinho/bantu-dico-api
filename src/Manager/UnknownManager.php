<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:56.
 */

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Unknown;
use App\Repository\UnknownRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UnknownManager.
 */
class UnknownManager extends AbstractManager implements ManagerInterface
{
    /**
     * @var UnknownRepository
     */
    protected $repository;

    /**
     * UnknownManager constructor.
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->repository = $this->getEntityManager()->getRepository(Unknown::class);
    }

    public function findById(int $id): ?Unknown
    {
        return $this->repository->find($id);
    }

    /**
     * @return Unknown[]|object[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
