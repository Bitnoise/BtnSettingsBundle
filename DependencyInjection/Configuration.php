<?php

namespace Btn\SettingsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Validate configuration tree
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('btn_settings');
        $rootNode
            ->children()
                ->scalarNode('driver')->defaultValue('doctrine')
                    ->validate()
                        ->ifTrue(function($v) { return !in_array($v, array('doctrine')); })
                        ->thenInvalid('Invalid btn_settings driver specified: %s')
                    ->end()
                ->end();

        return $treeBuilder;
    }
}
