<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Entity;

use Sylius\Component\Attribute\Model\Attribute as BaseAttribute;

class Attribute implements AttributeInterface
{
    protected ?int $id;

    protected ?Group $group;

    protected BaseAttribute $syliusAttribute;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function setGroup(?Group $group): void
    {
        $this->group = $group;
    }

    public function getSyliusAttribute(): BaseAttribute
    {
        return $this->syliusAttribute;
    }

    public function setSyliusAttribute(BaseAttribute $syliusAttribute): void
    {
        $this->syliusAttribute = $syliusAttribute;
    }
}
