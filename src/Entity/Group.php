<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
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
