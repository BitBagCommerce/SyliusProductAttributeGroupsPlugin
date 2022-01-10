<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Form\Extension;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Group;
use Sylius\Bundle\ProductBundle\Form\Type\ProductAttributeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductAttributeTypeExtension extends AbstractTypeExtension
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
    {
		$builder->add('group', EntityType::class, [
            'class' => Group::class,
			'choice_label' => 'name',
			'mapped' => false,
			'required' => false,
			'placeholder' => '',
			'empty_data'  => null,
        ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductAttributeType::class];
    }
}
