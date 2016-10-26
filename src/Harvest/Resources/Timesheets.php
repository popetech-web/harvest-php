<?php

namespace Harvest\Resources;

use Harvest\Api\Connection;

/**
 * Class Timesheets
 *
 * @namespace    Harvest\Resources
 * @author     Joridos <joridoss@gmail.com>
 */
class Timesheets extends AbstractResource implements ResourceInterface
{
    const HARVEST_PATH_DAILY = 'daily';

	/**
     * @param DateTime $forDay
     * @param string|DateTime $updatedSince
     * @return string
     */
    public function getAllForDay(\DateTime $forDay = null, $updatedSince = null)
    {
        if (is_null($forDay))
            $forDay = new \DateTime();

        $dayOfTheYear = $forDay->format("z")+1;
        $year = $forDay->format("Y");

        $newUri = null;

        $newUri = '?' . http_build_query(array('updated_since' => $this->_appendUpdatedSinceParam($updatedSince)));

        $this->_uri = self::HARVEST_PATH_DAILY . "{$dayOfTheYear}/{$year}" . $newUri;
        return parent::getAll();
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
        $all = json_decode($this->getAllForDay(), true);
        $actives = array_filter($all, function ($data) {
            return true; // active not available - so return all entries
        });

        return $actives;
    }
}