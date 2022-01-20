<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Factory;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\AttributeInterface as BundleAttributeInterface;
use BitBag\SyliusProductAttributeGroupsPlugin\Entity\GroupInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface AttributeFactoryInterface extends FactoryInterface
{
    public function createWithGroup(GroupInterface $group, ProductAttributeInterface $syliusAttribute): BundleAttributeInterface;
}
