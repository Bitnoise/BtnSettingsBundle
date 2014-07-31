<?php

namespace Btn\SettingsBundle\Model;

interface SettingInterface
{
    /**
     * Set config value
     *
     * @param string $name
     * @param string $value
     **/
    public function set($name, $value);

    /**
     * Get config value
     *
     * @param string $name
     **/
    public function get($name);

    /**
     * Get all settings
     *
     * @return array $items
     **/
    public function getAll();
}
