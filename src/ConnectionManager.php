<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 27/03/18
 * Time: 1:45 PM
 */

namespace Wtf\Database;

use Wtf\Database\Connections\DataConnection;

/**
 * Class ConnectionManager
 *
 * @package Wtf\Database
 */
class ConnectionManager
{
    /** @var array DataConnection */
    protected $_connections = [];

    /**
     * Adds a database connection to the manager.
     *
     * @param string $connectionName
     * @param DataConnection $connection
     * @return bool
     */
    public function addConnection(string $connectionName, DataConnection $connection) {
        if($this->hasConnection($connectionName)) {
            return false;
        }
        $this->_connections[$connectionName] = $connection;
        return true;
    }

    /**
     * Replace an existing database connection in the manager.
     *
     * @param string $connectionName
     * @param DataConnection $connection
     * @return bool
     */
    public function replaceConnection(string $connectionName, DataConnection $connection) : bool
    {
        if($this->hasConnection($connectionName)) {
            $this->_connections[$connectionName] = $connection;
            return true;
        }
    }

    /**
     * Load an array of database connections/
     *
     * @param array $connections
     */
    public function loadConnections(array $connections) {
        foreach($connections as $connectionName => $connection) {
            $this->_connections[$connectionName] = $connection;
        }
    }

    /**
     * Get a specific database connection.
     *
     * @param string $connectionName
     * @return mixed
     */
    public function getConnection(string $connectionName) {
        return $this->_connections[$connectionName];
    }

    /**
     * Checks for an existing database connection by name.
     *
     * @param string $connectionName
     * @return bool
     */
    protected function hasConnection(string $connectionName) : bool
    {
        return array_key_exists($connectionName, $this->_connections);
    }
}