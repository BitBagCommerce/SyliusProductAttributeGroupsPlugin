<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Factory;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Group;
use BitBag\SyliusProductAttributeGroupsPlugin\Entity\GroupInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class GroupFactory implements FactoryInterface
{
    public function createNew(): GroupInterface
    {
        return new Group();
    }
}
