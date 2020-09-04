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
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractHandler.
 */
class AbstractHandler
{
    public const URL_YANDEX = 'https://dictionary.yandex.net/api/v1/dicservice.json/lookup';

    /**
     * @var SerializerHandler
     */
    protected $serializerHandler;

    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->serializerHandler = new SerializerHandler();
        $this->client = new Client();
    }

    /**
     * Check if word exists in french dictionary.
     *
     * @param string $word
     * @return bool
     * @throws GuzzleException
     */
    public function isWordValid(string $word): bool
    {
        $response = $this->client
            ->request('GET', self::URL_YANDEX, [
                'query' => [
                    'key' => $_ENV['YANDEX_API_KEY'],
                    'lang' => 'fr-fr',
                    'text' => $word
                ]
            ]);

        if (Response::HTTP_OK !== $response->getStatusCode()) {
            return false;
        }

        $result = json_decode($response->getBody()->getContents());

        if (empty($result->def)) {
            return false;
        }

        return true;
    }
}
