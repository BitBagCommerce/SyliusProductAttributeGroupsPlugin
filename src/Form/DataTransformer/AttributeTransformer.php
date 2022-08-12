<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Form\DataTransformer;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Attribute;
use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Form\DataTransformerInterface;

class AttributeTransformer implements DataTransformerInterface
{
    private FactoryInterface $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function transform($value): ArrayCollection
    {
        $collection = new ArrayCollection();

        /** @var Attribute $attribute */
        foreach ($value as $attribute) {
            $collection->add($attribute->getSyliusAttribute());
        }

        return $collection;
    }

    public function reverseTransform($value): ArrayCollection
    {
        $collection = new ArrayCollection();

        foreach ($value as $attribute) {
            /** @var Attribute $pluginAttribute */
            $pluginAttribute = $this->factory->createNew();
            $pluginAttribute->setSyliusAttribute($attribute);
            $collection->add($pluginAttribute);
        }

        return $collection;
    }
}
