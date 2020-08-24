<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:56.
 */

declare(strict_types=1);

namespace App\Manager;

use App\Entity\FrenchSango;
use App\Handler\ElasticHandler;
use App\Repository\FrenchSangoRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class FrenchSangoManager.
 */
class FrenchSangoManager extends AbstractManager implements ManagerInterface
{
    /**
     * @var FrenchSangoRepository
     */
    protected $repository;

    /**
     * FrenchSangoManager constructor.
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->repository = $this->getEntityManager()->getRepository(FrenchSango::class);
        $this->finder = $this->getElasticsearchIndex(ElasticHandler::INDEX_FRENCH_SANGO);
    }

    public function findById(int $id): array
    {
        return $this->search('id', $id);
    }

    /**
     * @return FrenchSango[]|object[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
