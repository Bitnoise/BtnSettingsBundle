<?php

namespace Btn\SettingsBundle\Factory;

use Doctrine\ORM\EntityManager;
use Btn\SettingsBundle\Model\SettingInterface;

/**
 * Main Settings service (factory)
 *
 * @package btn.settings
 * @author  michalsoczynski
 **/
class SettingsFactory
{
    /**
     * Driver must be instance of SettingsInterface
     *
     * @var SettingsInterface
     **/
    private $driver = null;

    /**
     * Array with key:value
     *
     * @var array
     **/
    private $data;

    /**
     * Constructor
     *
     * @param ServiceContainer $container
     * @param string $driver
     *
     **/
    public function __construct(EntityManager $em, $driver, $defaults = array())
    {
        $this->data = array();

        //create driver from providers
        $classname = '\\Btn\\SettingsBundle\\Model\\'.ucfirst($driver).'Driver';

        if(class_exists($classname)) {
            $this->driver = new $classname($em, $defaults);
        } else {
            //file not found
            throw $this->driverNotFoundException($driver);
        }

        //wrong interface
        if (!($this->driver instanceof SettingInterface)) {
            throw $this->wrongInterfaceException($driver);
        }

        //good to go - fetch all data from driver
        $this->data = $this->driver->getAll();
    }

    /**
     * set settings value for provided key
     *
     * @param string $key
     * @param string $value
     *
     * @return boolean $status
     **/
    public function set($key, $value)
    {
        //get from local memory or from driver
        return $this->driver->set($key, $value);
    }

    /**
     * return value from our data by $key
     *
     * @param string $key
     *
     * @return string
     **/
    public function get($key)
    {
        //get from local memory or from driver
        return (isset($this->data[$key]) ? $this->data[$key] : $this->driver->get($key));
    }

    /**
     * Return all entities from table Settings
     *
     * @return array
     *
     **/
    public function getAll()
    {
        return $this->driver->getAll();
    }

    /**
     *
     * @param string $name Driver name.
     * @return \RuntimeException
     */
    protected function driverNotFoundException($name) {

        return new \RuntimeException(sprintf('Settings driver "%s" couldn\'t be found.', $name));
    }

    /**
     *
     * @param string $name Driver name.
     * @return \RuntimeException
     */
    protected function wrongInterfaceException($name) {

        return new \RuntimeException(sprintf('Settings driver "%s" doesn\'t implement the SettingsInterface interface.', $name));
    }
}