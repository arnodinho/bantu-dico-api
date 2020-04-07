<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:56.
 */

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Page;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PageManager.
 */
class PageManager extends AbstractManager
{
    /**
     * @var PageRepository
     */
    protected $repository;
    
    /**
     * PageManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->repository = $this->getEntityManager()->getRepository(Page::class);
    }

    /**
     * @param int $id
     * @return Page|null
     */
    public function findById(int $id): ?Page
    {
        return $this->repository->find($id);
    }

    /**
     * @return Page[]|object[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
