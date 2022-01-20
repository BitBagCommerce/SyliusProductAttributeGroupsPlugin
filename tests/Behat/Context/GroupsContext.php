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
use Sylius\Behat\NotificationType;
use Sylius\Behat\Service\NotificationChecker;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group\CreateGroupPageInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group\IndexGroupPageInterface;
use Webmozart\Assert\Assert;

final class GroupsContext implements Context
{
    private CreateGroupPageInterface $createPage;

    private NotificationChecker $notificationChecker;

    private IndexGroupPageInterface $indexPage;

    public function __construct(
        CreateGroupPageInterface $createPage,
        IndexGroupPageInterface $indexPage,
        NotificationChecker $notificationChecker
    ) {
        $this->createPage = $createPage;
        $this->indexPage = $indexPage;
        $this->notificationChecker = $notificationChecker;
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
}
