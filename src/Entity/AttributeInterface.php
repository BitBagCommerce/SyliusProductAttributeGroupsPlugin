<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Entity;

use Sylius\Component\Attribute\Model\AttributeInterface as SyliusAttributeInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface AttributeInterface extends ResourceInterface
{
    public function getGroup(): ?GroupInterface;

    public function setGroup(?GroupInterface $group): void;

    public function getSyliusAttribute(): SyliusAttributeInterface;

    public function setSyliusAttribute(SyliusAttributeInterface $syliusAttribute): void;
}
