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
    private $client;

    /**
     * Harvest constructor.
     * @param $username
     * @param $password
     * @param $account
     */
    public function __construct($username, $password, $account)
    {
        $this->client = new Connection(array( 'username' => $username, 'password' => $password, 'account' => $account));
        $this->projects = new Projects($this->client);
        $this->clients = new Clients($this->client);
        $this->tasks = new Clients($this->client);
    }

    /**
     * @param null $username
     * @param null $password
     * @return Connection|GuzzleHttp\Psr7\Response
     */
    private function getConnection($username = null, $password = null)
    {
        if (is_null($this->client)
            && !is_null($username)
            && !is_null($password)) {
            $this->client = new Connection(array($username, $password));
        }

        return clone $this->client;
    }

    /**
     * @return Projects|GuzzleHttp\Psr7\Response
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @return Projects|GuzzleHttp\Psr7\Response
     */
    public function getClients()
    {
        return $this->projects;
    }

    /**
     * @return Clients|GuzzleHttp\Psr7\Response
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
