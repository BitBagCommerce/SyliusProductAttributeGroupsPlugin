<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Form\Type;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Group;
use BitBag\SyliusProductAttributeGroupsPlugin\Form\DataTransformer\AttributeTransformer;
use Sylius\Bundle\ProductBundle\Form\Type\ProductAttributeChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class GroupType extends AbstractResourceType
{
    private AttributeTransformer $transformer;

    public function __construct(AttributeTransformer $transformer)
    {
        parent::__construct(Group::class);
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['autocomplete' => 'off'],
            ])
            ->add('attributes', ProductAttributeChoiceType::class, [
                'multiple' => true,
                'attr' => [
                    'class' => 'fluid search selection multiple',
                ],
            ]);

        $builder->get('attributes')->addModelTransformer($this->transformer);
    }
}
