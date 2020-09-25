<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 25/09/2020
 * Time: 14:04.
 */

namespace App\Tests\Serializer;

use App\Serializer\SerializerHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerHandlerTest extends TestCase
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var SerializerHandler
     */
    protected $serializerHandler;

    protected function setUp(): void
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
        $this->serializerHandler =  new SerializerHandler();
    }
    public function testGetSerializer(): void
    {
        $this->assertEquals(
            $this->serializer,
            $this->serializerHandler->getSerializer()
        );
    }
}
