<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Form\Type;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Group;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Component\Product\Model\ProductAttribute;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class GroupType extends AbstractResourceType {
	public function __construct() {
		parent::__construct(Group::class);
	}

	public function buildForm(FormBuilderInterface $builder, array $options): void {
		$builder
			->add('name', TextType::class)
			->add('attributes', EntityType::class, [
				'class' => ProductAttribute::class,
				'multiple' => true,
				'mapped' => false
			]);
	}
}
