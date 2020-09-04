<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:56.
 */

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Sango;
use App\Handler\ElasticHandler;
use App\Repository\SangoRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class SangoManager.
 */
class SangoManager extends AbstractManager implements ManagerInterface
{
    /**
     * @var SangoRepository
     */
    protected $repository;

    /**
     * SangoManager constructor.
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->repository = $this->getEntityManager()->getRepository(Sango::class);
        $this->finder = $this->getElasticsearchIndex(ElasticHandler::INDEX_SANGO);
    }

    public function findById(int $id): array
    {
        return $this->search('id', $id);
    }

    /**
     * @return Sango[]|object[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function getRepository(): SangoRepository
    {
        return $this->repository;
    }
}
