<?php

namespace Harvest\Resources;

use DateTime;
use Harvest\Api\Connection;

/**
 * Class Projects
 *
 * @namespace    Harvest\Resources
 * @author     Joridos <joridoss@gmail.com>
 */
class Projects extends AbstractResource implements ResourceInterface
{
    const PATH = 'projects';

    /**
     * @param integer $clientId
     * @param string|DateTime $updatedSince
     * @return string
     */
    public function getAll($clientId = null, $updatedSince = null)
    {
        $newUri = null;

        $newUri = '?' . http_build_query(array('client' => $clientId, 'updated_since' => $this->appendUpdatedSinceParam($updatedSince)));

        $this->uri = self::PATH . $newUri;
        return parent::getAll();
    }

    /**
     * @return string
     */
    public function getInactive()
    {
        $all = json_decode($this->getAll(), true);
        $actives = array_filter($all, function ($data) {
            return $data['project']['active'] == false;
        });

        return $actives;
    }

    /**
     * @return string
     */
    public function getActive()
    {
        $all = json_decode($this->getAll(), true);
        $actives = array_filter($all, function ($data) {
            return $data['project']['active'] == true;
        });

        return $actives;
    }

    /**
     * @param string|DateTime $updatedSince
     * @return bool|string
     */
    private function appendUpdatedSinceParam($updatedSince = null)
    {
        if( is_null($updatedSince) ) {
            return false;
        } else if( $updatedSince instanceOf DateTime ) {
            return urlencode($updatedSince->format("Y-m-d G:i"));
        } else {
            return urlencode($updatedSince);
        }
    }

}