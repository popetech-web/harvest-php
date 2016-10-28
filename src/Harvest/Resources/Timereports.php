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
class Timereports extends AbstractResource implements ResourceInterface
{
    const HARVEST_PATH = 'entries';
    const HARVEST_PATH_FOR_PROJECTS = 'projects';
    const HARVEST_PATH_FOR_USERS = 'people';

    /**
     * @param string $basePath
     * @param string $dateFrom
     * @param string $dateTo
     * @param string|DateTime $updatedSince
     * @return string
     */
    public function getAll($basePath, $dateFrom, $dateTo = null, $updatedSince = null)
    {
        $newUri = null;

        if (is_null($dateTo))
            $dateTo = date("Ymd");

        $newUri = '?' . http_build_query(array('from' => $dateFrom, 'to' => $dateTo, 'updated_since' => $this->_appendUpdatedSinceParam($updatedSince)));

        $this->_uri = $basePath . self::HARVEST_PATH . $newUri;
        return parent::getAll();
    }

    /**
     * @param integer $userId
     * @param string $dateFrom
     * @param string $dateTo
     * @param string|DateTime $updatedSince
     * @return string
     */
    public function getAllForUser($userId, $dateFrom, $dateTo = null, $updatedSince = null)
    {
        $basePath = self::HARVEST_PATH_FOR_USERS . "/{$userId}/";
        return $this->getAll($basePath, $dateFrom, $dateTo, $updatedSince);
    }

    /**
     * @param integer $projectId
     * @param string $dateFrom
     * @param string $dateTo
     * @param string|DateTime $updatedSince
     * @return string
     */
    public function getAllForProject($projectId, $dateFrom, $dateTo = null, $updatedSince = null)
    {
        $basePath = self::HARVEST_PATH_FOR_PROJECTS . "/{$projectId}/";
        return $this->getAll($basePath, $dateFrom, $dateTo, $updatedSince);
    }

    /**
     * @return string
     */
    public function getInactive()
    {
        // not available for this resource - so return empty string
        return "";
    }

    /**
     * @return string
     */
    public function getActive()
    {
        // not available for this resource - so return empty string
        return "";
    }
}