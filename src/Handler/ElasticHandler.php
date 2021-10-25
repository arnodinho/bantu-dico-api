<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 14/07/2020
 * Time: 16:33.
 */

namespace App\Handler;

use Elastica\Query\BoolQuery;
use Elastica\Query\Match;
use FOS\ElasticaBundle\Elastica\Client;

/**
 * Class ElasticHandler.
 */
class ElasticHandler
{
    const INDEX_FRENCH = 'french';
    const INDEX_SANGO = 'sango';
    const INDEX_LINGALA = 'lingala';
    const INDEX_FRENCH_SANGO = 'french_sango';

    /**
     * @var Client
     */
    private $client;

    private static $instance;

    /**
     * Singleton.
     *
     * @return ElasticHandler
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new ElasticHandler();
        }

        return self::$instance;
    }

    /**
     * constructor.
     */
    private function __construct()
    {
        $this->client = new Client(['host' => 'elasticsearch', 'port' => 9200]);
        $this->client->connect();
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param string|int $field
     * @param $query
     *
     * @return BoolQuery
     */
    public function getQuery(string $field, $query)
    {
        $fieldQuery = new Match();
        $boolQuery = new BoolQuery();

        $fieldQuery->setFieldQuery($field, $query);
        $fieldQuery->setFieldParam($field, 'analyzer', 'custom_analyzer');

        return $boolQuery->addShould($fieldQuery);
    }

    public function formatDateFormArrayResult(array $data): array
    {
        if ($data['created_at']) {
            $data['created_at'] = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created_at']);
        }
        if ($data['updated_at']) {
            $data['updated_at'] = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['updated_at']);
        }

        //remove nullable value in array for denormalisation process
        $result = array_filter($data, function ($value) {
            return !empty($value);
        } );


        return $result;
    }
}
