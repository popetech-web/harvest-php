<?php

namespace Harvest\Resources;

use GuzzleHttp\Client as GuzzleClient;
use Harvest\Api\Connection;

/**
 * Class AbstractResource
 *
 * @namespace    Harvest\Resources
 * @author     Joridos <joridoss@gmail.com>
 */
abstract class AbstractResource
{
    private $connection;
    protected $uri;

    /**
     * AbstractResource constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->uri = '';
    }

    /**
     * @return string
     */
    public function getAll()
    {
        return $this->connection->request('GET', $this->uri);
    }
}