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
use App\Handler\ElasticHandler;
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
        $this->finder = $this->getElasticsearchIndex(ElasticHandler::INDEX_FRENCH);
    }

    /**
     * @return French[]|object[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function getRepository(): FrenchRepository
    {
        return $this->repository;
    }
}
