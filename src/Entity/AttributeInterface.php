<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

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
