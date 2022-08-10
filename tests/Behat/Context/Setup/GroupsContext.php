<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use BitBag\SyliusProductAttributeGroupsPlugin\Entity\GroupInterface;
use BitBag\SyliusProductAttributeGroupsPlugin\Factory\AttributeFactoryInterface;
use Sylius\Component\Attribute\Factory\AttributeFactoryInterface as SyliusAttributeFactoryInterface;
use Sylius\Component\Core\Formatter\StringInflector;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class GroupsContext implements Context
{
    private FactoryInterface $groupFactory;

    private AttributeFactoryInterface $attributeFactory;

    private SyliusAttributeFactoryInterface $syliusAttributeFactory;

    private RepositoryInterface $attributeRepository;

    private RepositoryInterface $syliusAttributeRepository;

    private RepositoryInterface $groupRepository;

    public function __construct(
        FactoryInterface $groupFactory,
        AttributeFactoryInterface $attributeFactory,
        SyliusAttributeFactoryInterface $syliusAttributeFactory,
        RepositoryInterface $attributeRepository,
        RepositoryInterface $syliusAttributeRepository,
        RepositoryInterface $groupRepository
    ) {
        $this->groupFactory = $groupFactory;
        $this->attributeFactory = $attributeFactory;
        $this->syliusAttributeFactory = $syliusAttributeFactory;
        $this->attributeRepository = $attributeRepository;
        $this->syliusAttributeRepository = $syliusAttributeRepository;
        $this->groupRepository = $groupRepository;
    }

    /**
     * @Given the store has a product attribute group :groupName with attributes:
     */
    public function theStoreHasAProductAttributeGroup(string $groupName, TableNode $table): void
    {
        /** @var GroupInterface $group */
        $group = $this->groupFactory->createNew();
        $group->setName($groupName);
        $this->groupRepository->add($group);

        $attributeNames = array_merge([], ...$table->getRows());

        foreach ($attributeNames as $attributeName) {
            $syliusAttribute = $this->createProductAttribute($attributeName);
            $this->syliusAttributeRepository->add($syliusAttribute);

            $attribute = $this->attributeFactory->createWithGroup($group, $syliusAttribute);
            $this->attributeRepository->add($attribute);
        }
    }

    private function createProductAttribute(
        string $name,
        ?string $code = null,
        string $type = 'text',
        bool $translatable = true
    ): ProductAttributeInterface {
        /** @var ProductAttributeInterface $productAttribute */
        $productAttribute = $this->syliusAttributeFactory->createTyped($type);

        $code = $code ?: StringInflector::nameToCode($name);

        $productAttribute->setCode($code);
        $productAttribute->setTranslatable($translatable);
        $productAttribute->setName($name);

        return $productAttribute;
    }


}
