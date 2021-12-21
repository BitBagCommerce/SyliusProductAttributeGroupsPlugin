<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Entity;

use Sylius\Component\Attribute\Model\AttributeInterface as SyliusAttributeInterface;

class Attribute implements AttributeInterface
{
    protected ?int $id;

    protected ?GroupInterface $group;

    protected SyliusAttributeInterface $syliusAttribute;

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

    public function getSyliusAttribute(): SyliusAttributeInterface
    {
        return $this->syliusAttribute;
    }

    public function setSyliusAttribute(SyliusAttributeInterface $syliusAttribute): void
    {
        $this->syliusAttribute = $syliusAttribute;
    }
}
