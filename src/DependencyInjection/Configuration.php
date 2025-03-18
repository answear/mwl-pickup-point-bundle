<?php

declare(strict_types=1);

namespace Answear\MwlBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('answear_mwl');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('partnerKey')->cannotBeEmpty()->end()
                ->scalarNode('secretKey')->cannotBeEmpty()->end()
            ->end();

        return $treeBuilder;
    }
}
