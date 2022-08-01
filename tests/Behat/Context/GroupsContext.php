<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Attribute;
use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Group;
use Doctrine\ORM\EntityManager;
use Sylius\Behat\NotificationType;
use Sylius\Behat\Page\Admin\Product\UpdateSimpleProductPage as BaseUpdateSimpleProductPage;
use Sylius\Behat\Service\Helper\JavaScriptTestHelperInterface;
use Sylius\Behat\Service\NotificationChecker;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Core\Formatter\StringInflector;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Product\Model\ProductAttribute;
use Sylius\Component\Product\Model\ProductAttributeTranslation;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group\CreateGroupPageInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group\IndexGroupPageInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Product\UpdateSimpleProductPage;
use Webmozart\Assert\Assert;
use function PHPUnit\Framework\assertEquals;

final class GroupsContext implements Context
{
    private CreateGroupPageInterface $createPage;

    private NotificationChecker $notificationChecker;

    private IndexGroupPageInterface $indexPage;

    private EntityManager $entityManager;

    private SharedStorageInterface $sharedStorage;

    private JavaScriptTestHelperInterface $testHelper;

    private ProductRepositoryInterface $productRepository;

    private UpdateSimpleProductPage $updateSimpleProductPage;

    private BaseUpdateSimpleProductPage $baseUpdateSimpleProductPage;

    public function __construct(
        CreateGroupPageInterface $createPage,
        NotificationChecker $notificationChecker,
        IndexGroupPageInterface $indexPage,
        EntityManager $entityManager,
        SharedStorageInterface $sharedStorage,
        JavaScriptTestHelperInterface $testHelper,
        ProductRepositoryInterface $productRepository,
        UpdateSimpleProductPage $productPage,
        BaseUpdateSimpleProductPage $baseUpdateSimpleProductPage
    ) {
        $this->createPage = $createPage;
        $this->notificationChecker = $notificationChecker;
        $this->indexPage = $indexPage;
        $this->entityManager = $entityManager;
        $this->sharedStorage = $sharedStorage;
        $this->testHelper = $testHelper;
        $this->productRepository = $productRepository;
        $this->updateSimpleProductPage = $productPage;
        $this->baseUpdateSimpleProductPage = $baseUpdateSimpleProductPage;
    }

    /**
     * @Given there is created group with name :group
     */
    public function thereIsCreatedGroupWithName(string $group): void
    {
        $this->createPage->createGroup($group);
    }

    /**
     * @When I want to add a new attribute group
     */
    public function iWantToAddANewAttributeGroup(): void
    {
        $this->createPage->open();
    }

    /**
     * @When I set its name to :group
     */
    public function iSetItsNameTo(string $group): void
    {
        $this->createPage->fillName($group);
    }

    /**
     * @When I add it
     */
    public function iAddIt(): void
    {
        $this->createPage->create();
    }

    /**
     * @When I assign this attributes to group:
     */
    public function iAssignThisAttributesToGroup(TableNode $table): void
    {
        $codes = array_merge([], ...$table->getRows());

        $this->createPage->assignAttributes($codes);
    }

    /**
     * @Then I should be notified that the group has been created
     */
    public function iShouldBeNotifiedThatTheGroupHasBeenCreated(): void
    {
        $this->notificationChecker->checkNotification(
            'Group has been successfully created.',
            NotificationType::success()
        );
    }

    /**
     * @Then the group :group should appear in the store
     */
    public function theGroupShouldAppearInTheStore(string $group): void
    {
        Assert::true(
            $this->indexPage->isGroupDisplayed($group),
            'Group is not displayed on index page.'
        );
        Assert::true(
            $this->indexPage->isSingleResourceOnPage(['name' => $group]),
            'There should exist only one group but it does not.'
        );
    }

    /**
     * @Given these attributes should be visible next to the group :group:
     */
    public function thisAttributesShouldBeVisibleNextToTheGroup(string $group, TableNode $table): void
    {
        $attributes = array_merge([], ...$table->getRows());

        Assert::true(
            $this->indexPage->areAttributesVisible($group, $attributes)
        );
    }

    /**
     * @Given the store has a product attribute group :groupName with attributes:
     */
    public function theStoreHasAProductAttributeGroup(string $groupName, TableNode $table)
    {
        $group = new Group();
        $group->setName($groupName);

        $attributeNames = array_merge([], ...$table->getRows());

        foreach ($attributeNames as $attributeName) {
            $attributeCode = StringInflector::nameToCode($attributeName);

            $attributeTranslation = new ProductAttributeTranslation();
            $attributeTranslation->setName($attributeName);
            $attributeTranslation->setLocale('en_US');

            $syliusAttribute = new ProductAttribute();
            $syliusAttribute->setCode($attributeCode);
            $syliusAttribute->setType('text');
            $syliusAttribute->setStorageType('text');
            $syliusAttribute->setTranslatable(true);
            $syliusAttribute->addTranslation($attributeTranslation);

            $attribute = new Attribute();
            $attribute->setGroup($group);
            $attribute->setSyliusAttribute($syliusAttribute);

            $this->entityManager->persist($attributeTranslation);
            $this->entityManager->persist($syliusAttribute);
            $this->entityManager->persist($attribute);
        }

        $this->entityManager->persist($group);

        $this->entityManager->flush();
    }


    /**
     * @When I want to modify the :productName product
     * @When /^I want to modify (this product)$/
     * @When I modify the :product product
     */
    public function iWantToModifyAProduct(string $productName): void
    {
        $product = $this->productRepository->findOneByCode($productName);

        $this->sharedStorage->set('product', $product);
        if ($product->isSimple()) {
            $this->testHelper->waitUntilPageOpens($this->baseUpdateSimpleProductPage, ['id' => $product->getId()]);

            return;
        }

        $this->testHelper->waitUntilPageOpens($this->baseUpdateSimpleProductPage, ['id' => $product->getId()]);
    }

    /**
     * @When I open :tab tab
     */
    public function iOpenTab(string $tabName)
    {
        $this->updateSimpleProductPage->openTab($tabName);
    }

    /**
     * @When I select attribute group
     */
    public function iSelectAttributeGroup()
    {
        $this->updateSimpleProductPage->selectAttributeGroup();
    }

    /**
     * @When I save product changes
     */
    public function iSaveProductChanges()
    {
        $this->updateSimpleProductPage->saveChanges();
    }

    /**
     * @Then I should be notified that it has been successfully edited
     */
    public function iShouldBeNotifiedThatItHasBeenSuccessfullyEdited(): void
    {
        $this->testHelper->waitUntilNotificationPopups(
            $this->notificationChecker,
            NotificationType::success(),
            'has been successfully updated.'
        );
    }

    /**
     * @When I set its :attribute attribute to :value
     * @When I set its :attribute attribute to :value in :language
     * @When I do not set its :attribute attribute in :language
     */
    public function iSetItsAttributeTo($attribute, $value = null, $language = 'en_US')
    {
        $this->updateSimpleProductPage->addAttributeValue($attribute, $value ?? '', $language);
    }

    /**
     * @Then attribute :attributeName of product :product should be :value
     * @Then attribute :attributeName of product :product should be :value in :language
     */
    public function itsAttributeShouldBe($attributeName, ProductInterface $product, $value, $language = 'en_US')
    {
        Assert::same($this->updateSimpleProductPage->getAttributeValue($attributeName, $language), $value);
    }

    /**
     * @Then I should see button to add AttributesGroup
     */
    public function iShouldSeeButtonToAddAttributesGroup()
    {
        $buttonAddAttributesGroupName = $this->updateSimpleProductPage->getButtonToAddAttributesGroup();
        assertEquals('add_attributes_group', $buttonAddAttributesGroupName);
    }

}
