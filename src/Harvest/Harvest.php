<?php
namespace Harvest;

use Harvest\Api\Connection;
use Harvest\Resources\Projects;
use Harvest\Resources\Clients;

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
        $this->tasks = new Clients($this->_connection);
    }

    /**
     * @return Projects
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @return Projects
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * @return Clients
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
