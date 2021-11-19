<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 07/04/2020
 * Time: 15:17.
 */

namespace App\Handler;

use App\Entity\StorableEntityInterface;

interface HandlerInterface
{
    /**
     * @return mixed
     */
    public function retrieveById(int $id);

    public function delete(StorableEntityInterface $entity);

    public function retrieveAll(): ?array;

    public function create(StorableEntityInterface $entity): void;

    public function update(StorableEntityInterface $entity): void;
}
