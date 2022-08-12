<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Context\Ui;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Sylius\Behat\NotificationType;
use Sylius\Behat\Page\Admin\Product\UpdateSimpleProductPage as BaseUpdateSimpleProductPage;
use Sylius\Behat\Service\Helper\JavaScriptTestHelperInterface;
use Sylius\Behat\Service\NotificationChecker;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group\CreateGroupPageInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group\IndexGroupPageInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Product\UpdateSimpleProductPage;
use Webmozart\Assert\Assert;
use function PHPUnit\Framework\assertEquals;

final class GroupsContext implements Context
{
    private CreateGroupPageInterface $createGroupPage;

    private NotificationChecker $notificationChecker;

    private IndexGroupPageInterface $indexPage;

    private SharedStorageInterface $sharedStorage;

    private JavaScriptTestHelperInterface $testHelper;

    private ProductRepositoryInterface $productRepository;

    private UpdateSimpleProductPage $updateSimpleProductPage;

    private BaseUpdateSimpleProductPage $baseUpdateSimpleProductPage;

    public function __construct(
        CreateGroupPageInterface $createGroupPage,
        NotificationChecker $notificationChecker,
        IndexGroupPageInterface $indexPage,
        SharedStorageInterface $sharedStorage,
        JavaScriptTestHelperInterface $testHelper,
        ProductRepositoryInterface $productRepository,
        UpdateSimpleProductPage $productPage,
        BaseUpdateSimpleProductPage $baseUpdateSimpleProductPage
    ) {
        $this->createGroupPage = $createGroupPage;
        $this->notificationChecker = $notificationChecker;
        $this->indexPage = $indexPage;
        $this->sharedStorage = $sharedStorage;
        $this->testHelper = $testHelper;
        $this->productRepository = $productRepository;
        $this->updateSimpleProductPage = $productPage;
        $this->baseUpdateSimpleProductPage = $baseUpdateSimpleProductPage;
    }

    /**
     * @When I select attribute group
     */
    public function iSelectAttributeGroup(): void
    {
        $this->updateSimpleProductPage->selectAttributeGroup();
    }

    /**
     * @Given these attributes should be visible next to the :group group:
     */
    public function thisAttributesShouldBeVisibleNextToTheGroup(string $group, TableNode $table): void
    {
        $attributes = array_merge([], ...$table->getRows());

        Assert::true(
            $this->indexPage->areAttributesVisible($group, $attributes)
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
     * @When I want to add a new attribute group
     */
    public function iWantToAddANewAttributeGroup(): void
    {
        $this->createGroupPage->open();
    }

    /**
     * @When I set its name to :group
     */
    public function iSetItsNameTo(string $group): void
    {
        $this->createGroupPage->fillName($group);
    }

    /**
     * @When I assign this attributes to group:
     */
    public function iAssignThisAttributesToGroup(TableNode $table): void
    {
        $codes = array_merge([], ...$table->getRows());

        $this->createGroupPage->assignAttributes($codes);
    }

    /**
     * @Given there is created group with :group name
     */
    public function thereIsCreatedGroupWithName(string $group): void
    {
        $this->createGroupPage->createGroup($group);
    }

    /**
     * @When I save product changes
     */
    public function iSaveProductChanges(): void
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
     * @When I open :tab tab
     */
    public function iOpenTab(string $tabName): void
    {
        $this->updateSimpleProductPage->openTab($tabName);
    }

    /**
     * @When I want to modify the :productName product
     */
    public function iWantToModifyAProduct(string $productName): void
    {
        $product = $this->productRepository->findOneByCode($productName);

        $this->sharedStorage->set('product', $product);

        $this->testHelper->waitUntilPageOpens($this->baseUpdateSimpleProductPage, ['id' => $product->getId()]);
    }

    /**
     * @When I add it
     */
    public function iAddIt(): void
    {
        $this->createGroupPage->create();
    }
}
