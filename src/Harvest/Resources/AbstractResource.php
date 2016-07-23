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
    private $_connection;
    protected $_uri;

    /**
     * AbstractResource constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->_connection = $connection;
        $this->_uri = '';
    }

    /**
     * @return string
     */
    public function getAll()
    {
        return $this->_connection->request('GET', $this->_uri);
    }
}