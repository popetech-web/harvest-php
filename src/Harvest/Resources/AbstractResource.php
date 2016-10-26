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

    /**
     * @param string|DateTime $updatedSince
     * @return bool|string
     */
    protected function _appendUpdatedSinceParam($updatedSince = null)
    {
        if( is_null($updatedSince) ) {
            return false;
        } else if( $updatedSince instanceOf \DateTime ) {
            $updatedSince->setTimezone(new \DateTimeZone('Z')); // convert to correct harvest intern timezone
            return $updatedSince->format("Y-m-d G:i");
        } else {
            return $updatedSince;
        }
    }
}