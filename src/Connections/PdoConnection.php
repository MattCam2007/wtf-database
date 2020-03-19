<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 14/03/18
 * Time: 5:12 PM
 */

namespace Wtf\Database\Connections;

use PDO;
use PDOStatement;

/**
 * Class PdoConnection
 *
 * @package Wtf\Database\Connections
 */
class PdoConnection implements DataConnection
{
    protected $_connectionName;
    protected $_pdo;
    protected $_databaseName;
    protected $_config;

    /**
     * PdoConnection constructor.
     *
     * @param string $databaseName
     * @param null $config
     * @throws \Exception
     */
    public function __construct($databaseName = '', $config = null) {
        $this->_config = $config;
        try {
            $this->_pdo = new PDO($this->_config['dsn'], $this->_config['username'],
                $this->_config['password'], $this->_config['options']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Close the PDO connection when object goes out of scope.
     */
    public function __destruct()
    {
        $this->_pdo = null;
    }

    /**
     * Prepare a SQL command.
     *
     * @param string $query
     * @return bool|PDOStatement
     */
    public function prepare(string $query) {
        return $this->_pdo->prepare($query);
    }
}