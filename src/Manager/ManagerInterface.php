<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 07/04/2020
 * Time: 14:54.
 */

namespace App\Manager;

/**
 * Interface ManagerInterface
 * @package App\Manager
 */
interface ManagerInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * @return array
     */
    public function findAll(): array;
}
