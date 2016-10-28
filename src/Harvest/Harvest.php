<?php
namespace Harvest;

use Harvest\Api\Connection;
use Harvest\Resources\Tasks;
use Harvest\Resources\Clients;
use Harvest\Resources\Projects;
use Harvest\Resources\Timesheets;
use Harvest\Resources\Timereports;

/**
 * Class Harvest
 *
 * @namespace    Harvest
 * @author     Joridos <joridoss@gmail.com>
 */
class Harvest
{
    private $_connection;

    /**
     * Harvest constructor.
     * @param $username
     * @param $password
     * @param $account
     */
    public function __construct($username, $password, $account)
    {
        $this->_connection = new Connection(array( 'username' => $username, 'password' => $password, 'account' => $account));
        $this->projects = new Projects($this->_connection);
        $this->clients = new Clients($this->_connection);
        $this->tasks = new Tasks($this->_connection);
        $this->timesheets = new Timesheets($this->_connection);
        $this->timereports = new Timereports($this->_connection);
    }

    /**
     * @return Projects
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @return Clients
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * @return Tasks
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @return Timesheets
     */
    public function getTimesheets()
    {
        return $this->timesheets;
    }
}
