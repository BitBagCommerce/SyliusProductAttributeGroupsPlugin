<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Factory;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Attribute;
use BitBag\SyliusProductAttributeGroupsPlugin\Entity\AttributeInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class AttributeFactory implements FactoryInterface
{
    public function createNew(): AttributeInterface
    {
        return new Attribute();
    }
}
