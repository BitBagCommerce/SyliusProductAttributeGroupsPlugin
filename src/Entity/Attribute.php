<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Entity;

use Sylius\Component\Product\Model\ProductAttributeInterface;

class Attribute implements AttributeInterface
{
    protected ?int $id;

    protected ?GroupInterface $group;

    protected ProductAttributeInterface $syliusAttribute;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroup(): ?GroupInterface
    {
        return $this->group;
    }

    public function setGroup(?GroupInterface $group): void
    {
        $this->group = $group;
    }

    public function getSyliusAttribute(): ProductAttributeInterface
    {
        return $this->syliusAttribute;
    }

    public function setSyliusAttribute(ProductAttributeInterface $syliusAttribute): void
    {
        $this->syliusAttribute = $syliusAttribute;
    }
}
