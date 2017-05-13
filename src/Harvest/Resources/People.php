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
class People extends AbstractResource implements ResourceInterface
{
    const HARVEST_PATH = 'people';

    public function getAll()
    {
        $this->_uri = self::HARVEST_PATH;
        return parent::getAll();
    }

    /**
     * @return string
     */
    public function getInactive()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getActive()
    {
        return [];
    }
}