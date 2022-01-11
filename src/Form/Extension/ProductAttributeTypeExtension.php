<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Form\Extension;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Attribute;
use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Group;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Bundle\ProductBundle\Form\Type\ProductAttributeType;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class ProductAttributeTypeExtension extends AbstractTypeExtension
{
	private RepositoryInterface $repository;
	private EntityManagerInterface $entityManager;
	private FactoryInterface $factory;

	public function __construct(RepositoryInterface $repository, EntityManagerInterface $entityManager, FactoryInterface $factory){
		$this->repository = $repository;
		$this->entityManager = $entityManager;
		$this->factory = $factory;
	}

	public function buildForm(FormBuilderInterface $builder, array $options): void
    {
		$builder->add('group', EntityType::class, [
            'class' => Group::class,
			'choice_label' => 'name',
			'mapped' => false,
			'required' => false,
			'placeholder' => '',
        ]);

		$builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event){
			$form = $event->getForm();
			/** @var Attribute $attribute */
			$attribute = $this->repository->findOneBy(['syliusAttribute' => $event->getData()]);

			if (!$attribute) {
				return;
			}

			$group = $form->get('group');
			$group->setData($attribute->getGroup());
		});

		$builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
			$form = $event->getForm();
			$group = $form->get('group')->getData();

			if (!$form->isValid()) {
				return;
			}

			$previousGroup = $this->repository->findOneBy(['syliusAttribute' => $event->getData()]);

			if (($previousGroup !== $group && null !== $previousGroup) || null === $group) {
				$this->entityManager->remove($previousGroup);
			}

			/** @var Attribute $attribute */
			$attribute = $this->factory->createNew();
			$attribute->setGroup($group);
			$attribute->setSyliusAttribute($event->getData());

			$this->entityManager->persist($attribute);
			$this->entityManager->flush();
		});
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductAttributeType::class];
    }
}
