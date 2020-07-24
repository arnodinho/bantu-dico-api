<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 18/02/2020
 * Time: 17:31.
 */

declare(strict_types=1);

namespace App\Handler;

use App\Serializer\SerializerHandler;

/**
 * Class AbstractHandler.
 */
class AbstractHandler
{
    /**
     * @var SerializerHandler
     */
    protected $serializerHandler;

    public function __construct()
    {
        $this->serializerHandler = new SerializerHandler();
    }
}
