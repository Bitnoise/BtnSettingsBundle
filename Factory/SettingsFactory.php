<?php

namespace Btn\SettingsBundle\Factory;

/**
 * undocumented class
 *
 * @package btn.settings
 * @author  michalsoczynski
 **/
class SettingsFactory
{
    /**
     * Constructor
     *
     * @param ServiceContainer $container
     * @param string $driver
     *
     **/
    public function __construct($container, $driver)
    {
        $this->data = array();

        //set data
        switch ($driver) {
            case 'doctrine':

                //find all entities from database
                $this->data = $container->get('btn.settings.manager')->findAll();
                break;
        }
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
        return (isset($this->data[$key]) ? $this->data[$key] : false);
    }
}