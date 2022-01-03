<?php

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
