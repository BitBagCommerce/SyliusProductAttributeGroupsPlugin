<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Form\Type;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Group;
use BitBag\SyliusProductAttributeGroupsPlugin\Factory\AttributeFactory;
use BitBag\SyliusProductAttributeGroupsPlugin\Factory\GroupFactory;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Component\Product\Model\ProductAttribute;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GroupType extends AbstractResourceType
{
    private GroupFactory $groupFactory;

    private AttributeFactory $attributeFactory;

    private EntityManagerInterface $em;

    public function __construct(
        GroupFactory $groupFactory,
        AttributeFactory $attributeFactory,
        EntityManagerInterface $em
    )
    {
        parent::__construct(Group::class);
        $this->groupFactory = $groupFactory;
        $this->attributeFactory = $attributeFactory;
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('attributes', EntityType::class, [
                'class' => ProductAttribute::class,
                'multiple' => true,
                'mapped' => false,
            ]);

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event): void {
            $form = $event->getForm();
            $name = $form->get('name')->getData();
            $attributes = $form->get('attributes')->getData();

            $group = $this->groupFactory->createNew();
            $group->setName($name);

            foreach ($attributes as $attribute) {
                $newAttribute = $this->attributeFactory->createNew();
                $newAttribute->setSyliusAttribute($attribute);
                $newAttribute->setGroup($group);

                $group->addAttribute($newAttribute);
            }

            $this->em->persist($group);
            $this->em->flush();
        });
    }
}
