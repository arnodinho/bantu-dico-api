<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 07/04/2020
 * Time: 14:54.
 */

namespace App\Manager;

/**
 * Interface ManagerInterface.
 */
interface ManagerInterface
{
    /**
     * @return mixed
     */
    public function findById(int $id);

    public function findAll(): array;
}
