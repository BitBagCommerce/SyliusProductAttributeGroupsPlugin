<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
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
