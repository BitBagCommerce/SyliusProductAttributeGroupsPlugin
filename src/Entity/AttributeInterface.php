<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Entity;

use Sylius\Component\Attribute\Model\Attribute;
use Sylius\Component\Resource\Model\ResourceInterface;

interface AttributeInterface extends ResourceInterface
{
    public function getGroup(): ?Group;

    public function setGroup(?Group $group): void;

    public function getSyliusAttribute(): Attribute;

    public function setSyliusAttribute(Attribute $syliusAttribute): void;
}
