<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 16:59.
 */

declare(strict_types=1);

namespace App\Manager;

use App\Entity\StorableEntityInterface;
use App\Handler\ElasticHandler;
use Doctrine\ORM\EntityManagerInterface;
use FOS\ElasticaBundle\Elastica\Index;

/**
 * Class AbstractManager.
 */
class AbstractManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var Index
     */
    protected $finder;

    protected $match;

    /**
     * AbstractServiceManager constructor.
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }

    public function save(StorableEntityInterface $entity): void
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function delete(StorableEntityInterface $entity): void
    {
        $this->em->remove($entity);
        $this->em->flush();
    }

    public function getElasticsearchIndex(string $index): Index
    {
        return ElasticHandler::getInstance()->getClient()->getIndex($index);
    }

    public function search(string $identifier, $search): array
    {
        $result = [];

        $data = $this->finder->search(ElasticHandler::getInstance()->getQuery($identifier, $search))->getResults();

        if (!empty($data)) {
            $data = $data[0]->getData();
            $result = ElasticHandler::getInstance()->formatDateFormArrayResult($data);
        }

        return $result;
    }
}
