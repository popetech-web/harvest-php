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
    const HARVEST_PATH = 'projects';

    /**
     * @param integer $clientId
     * @param string|DateTime $updatedSince
     * @return string
     */
    public function getAll($clientId = null, $updatedSince = null)
    {
        $newUri = null;

        $newUri = '?' . http_build_query(array('client' => $clientId, 'updated_since' => $this->_appendUpdatedSinceParam($updatedSince)));

        $this->_uri = self::HARVEST_PATH . $newUri;
        return parent::getAll();
    }
    
    /**
     * @param integer $projectId
     * @param string|DateTime $updatedSince
     * @return string
     */
    public function getAssignments($projectId, $updatedSince = null) {
        $newUri = '/'.$projectId.'/task_assignments';

        $newUri .= '?' . http_build_query(array('updated_since' => $this->_appendUpdatedSinceParam($updatedSince)));

        $this->_uri = self::HARVEST_PATH . $newUri;
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
}
