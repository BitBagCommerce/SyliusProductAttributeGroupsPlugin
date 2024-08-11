<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
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
