<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('bitbag_sylius_product_attribute_groups');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
