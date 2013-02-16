<?php

namespace Btn\SettingsBundle\Extension;

/**
 * Settings service extension for twig
 *
 * @package btn.settings
 * @author  michalsoczynski
 **/
class SettingsTwigExtension extends \Twig_Extension
{
    /**
     * Factory model
     *
     * @var array $factory
     **/
    private $factory;

    /**
     * Constructor injection
     *
     * @param  SettingsFactory $factory
     * @return void
     **/
    public function __construct($factory)
    {
        $this->factory = $factory;
    }

    public function getFunctions() {
        return array(
            'btn_settings' => new \Twig_Function_Method($this, 'get'),
            'bs'           => new \Twig_Function_Method($this, 'get'), //alias for btn_settings
        );
    }

    public function get($key) {

        return $this->factory->get($key);
    }

    public function getName() {
        return 'btn.settings';
    }

}
