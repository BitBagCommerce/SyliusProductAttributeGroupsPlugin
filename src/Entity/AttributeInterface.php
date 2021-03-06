<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Entity;

use Sylius\Component\Product\Model\ProductAttributeInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface AttributeInterface extends ResourceInterface
{
    public function getGroup(): ?GroupInterface;

    public function setGroup(?GroupInterface $group): void;

    public function getSyliusAttribute(): ProductAttributeInterface;

    public function setSyliusAttribute(ProductAttributeInterface $syliusAttribute): void;
}
