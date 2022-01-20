<?php

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
