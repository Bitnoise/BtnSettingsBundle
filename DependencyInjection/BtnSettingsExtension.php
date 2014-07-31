<?php

namespace Btn\SettingsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * BtnSettingsExtension
 */
class BtnSettingsExtension extends Extension
{
    /**
     * Load configuration
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        //apply config
        $container->setParameter('btn_settings', array());
        $container->setParameter('btn_settings.defaults', array());
        $container->setParameter('btn_settings.driver', $config['driver']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

    }
}
