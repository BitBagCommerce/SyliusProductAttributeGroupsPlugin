<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Form\Extension;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Attribute;
use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Group;
use BitBag\SyliusProductAttributeGroupsPlugin\Factory\AttributeFactoryInterface;
use Sylius\Bundle\ProductBundle\Form\Type\ProductAttributeType;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class ProductAttributeTypeExtension extends AbstractTypeExtension
{
    private RepositoryInterface $attributeRepository;

    private AttributeFactoryInterface $attributeFactory;

    public function __construct(
        RepositoryInterface $attributeRepository,
        AttributeFactoryInterface $attributeFactory
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->attributeFactory = $attributeFactory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('groups', EntityType::class, [
            'multiple' => true,
            'class' => Group::class,
            'choice_label' => 'name',
            'mapped' => false,
            'required' => false,
            'placeholder' => '',
            'choice_value' => fn (?Group $group) => null !== $group ? $group->getName() : null,
            'attr' => [
                'class' => 'fluid search selection multiple',
            ],
        ]);

        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event): void {
            $form = $event->getForm();
            /** @var Attribute[] $attributes */
            $attributes = $this->attributeRepository->findBy(['syliusAttribute' => $event->getData()]);

            if (empty($attributes)) {
                return;
            }

            $groups = array_map(fn (Attribute $attribute) => $attribute->getGroup(), $attributes);

            $groupsField = $form->get('groups');
            $groupsField->setData($groups);
        });

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event): void {
            $form = $event->getForm();
            $syliusAttribute = $event->getData();
            $groupCollection = $form->get('groups')->getData();

            if (!$form->isValid()) {
                return;
            }

            $previousGroups = $this->attributeRepository->findBy(['syliusAttribute' => $event->getData()]);

            if (!empty($previousGroups)) {
                foreach ($previousGroups as $previousGroup) {
                    $this->attributeRepository->remove($previousGroup);
                }
            }

            if (empty($groupCollection)) {
                return;
            }

            foreach ($groupCollection as $group) {
                $attribute = $this->attributeFactory->createWithGroup($group, $syliusAttribute);
                $this->attributeRepository->add($attribute);
            }
        });
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductAttributeType::class];
    }
}
