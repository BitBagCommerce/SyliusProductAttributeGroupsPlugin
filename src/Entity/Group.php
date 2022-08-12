<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Group implements GroupInterface
{
    protected ?int $id;

    protected ?string $name;

    /** @var Collection|AttributeInterface[] */
    protected Collection $attributes;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(AttributeInterface $attribute): void
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
            $attribute->setGroup($this);
        }
    }

    public function removeAttribute(AttributeInterface $attribute): void
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
            $attribute->setGroup(null);
        }
    }

    public function getAttributeCodes(): array
    {
        $attributeCode = [];

        foreach ($this->getAttributes() as $attribute) {
            $attributeCode[] = $attribute->getSyliusAttribute()->getCode();
        }

        return $attributeCode;
    }
}
