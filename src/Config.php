<?php

namespace Wtf\Configuration;

/**
 * Class Config
 * @package Wtf\Configuration
 */
class Config
{
    protected $_configs;

    /**
     * Config constructor.
     *
     * Receives a path to a json file which contains configuration values
     *
     * @param string $path
     * @throws \Exception
     */
    public function __construct($path = 'config/wtf.json') {
        $this->_configs = json_decode(file_get_contents($path), true);
        if($this->_configs === false) {
            throw new \Exception("Unable to open config file - " . $path);
        }
    }

    /**
     * Returns a configuration value or section.
     *
     * @param $configSection
     * @return mixed
     * @throws \Exception
     */
    public function getConfig($configSection) {
        if(!isset($this->_configs[$configSection])) {
            throw new \Exception("Invalid config section");
        }
        return $this->_configs[$configSection];
    }
}