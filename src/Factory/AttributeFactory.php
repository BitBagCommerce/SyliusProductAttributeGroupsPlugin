<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Factory;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\AttributeInterface;
use BitBag\SyliusProductAttributeGroupsPlugin\Entity\GroupInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class AttributeFactory implements AttributeFactoryInterface
{
    private FactoryInterface $decoratedFactory;

    public function __construct(FactoryInterface $factory)
    {
        $this->decoratedFactory = $factory;
    }

    public function createNew(): object
    {
        return $this->decoratedFactory->createNew();
    }

    public function createWithGroup(GroupInterface $group, ProductAttributeInterface $syliusAttribute): AttributeInterface
    {
        /** @var AttributeInterface $attribute */
        $attribute = $this->decoratedFactory->createNew();
        $attribute->setGroup($group);
        $attribute->setSyliusAttribute($syliusAttribute);

        return $attribute;
    }
}
