<?php

namespace App\Cache;

use App\Entity\StorableEntityInterface;
use Snc\RedisBundle\Client\Phpredis\Client;

class RedisCache
{
    public const REDIS_LIFETIME = 3600;

    private Client $client;

    private string $namespace;

    private static $instance; // L'attribut qui stockera l'instance unique

    /**
     * Singleton.
     *
     * @return RedisCache
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new RedisCache();
        }

        return self::$instance;
    }

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->client->connect($_ENV['REDIS_HOST']);
    }

    public function set($key, StorableEntityInterface $value, string $namespace = 'default'): void
    {
        $this->client->set($this->getFormatedKey($namespace, $key), serialize($value), self::REDIS_LIFETIME);
    }

    private function getFormatedKey(string $namespace, string $key)
    {
        return sprintf('%s:%s', $namespace, $key);
    }

    /**
     * @param $key
     *
     * @return StorableEntityInterface|bool
     */
    public function get($key, string $namespace = 'default')
    {
        return unserialize($this->client->get($this->getFormatedKey($namespace, $key)));
    }

    public function delete(string $key, string $namespace = 'default'): void
    {
        if ($key = $this->getKey($namespace, $key)) {
            $this->client->del($key);
        }
    }
}
