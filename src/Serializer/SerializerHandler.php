<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 15/07/2020
 * Time: 14:19.
 */

namespace App\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SerializerHandler.
 */
class SerializerHandler implements SerializerInterface
{
    protected $serializer;

    public function __construct()
    {
        /**
         * To use the Serializer component,
         * set up the Serializer specifying which encoders and normalizer are going to be available:.
         */
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }
}
