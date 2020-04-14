<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 07/04/2020
 * Time: 15:17.
 */

namespace App\Handler;

interface HandlerInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function retrieveById(int $id);

    /**
     * @return array|null
     */
    public function retrieveAll(): ?array;

    /**
     * @param $entity
     * @return bool
     */
    public function create($entity);
}
