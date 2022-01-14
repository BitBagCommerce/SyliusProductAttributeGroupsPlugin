<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Context;

use Behat\Behat\Context\Context;
use FriendsOfBehat\PageObjectExtension\Page\SymfonyPageInterface;
use Sylius\Behat\NotificationType;
use Sylius\Behat\Service\NotificationChecker;
use Sylius\Behat\Service\Resolver\CurrentPageResolverInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\CreateGroupPageInterface;

final class AttributeGroupsContext implements Context
{
    private CreateGroupPageInterface $createPage;

    private CurrentPageResolverInterface $currentPageResolver;

    private NotificationChecker $notificationChecker;

    public function __construct(
        CreateGroupPageInterface $createPage,
        CurrentPageResolverInterface $currentPageResolver,
        NotificationChecker $notificationChecker
    )
    {
        $this->createPage = $createPage;
        $this->currentPageResolver = $currentPageResolver;
        $this->notificationChecker = $notificationChecker;
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
        $this->resolveCurrentPage()->fillName($group);
    }

    /**
     * @When I add it
     */
    public function iAddIt(): void
    {
        $this->createPage->create();
    }

    /**
     * @Then I should be notified that the group has been created
     */
    public function theGroupShouldAppearInTheStore(): void
    {
        $this->notificationChecker->checkNotification(
			'Group has been successfully created.',
			NotificationType::success()
		);
    }

    /** @return CreateGroupPageInterface */
    private function resolveCurrentPage(): SymfonyPageInterface
    {
        return $this->currentPageResolver->getCurrentPageWithForm([
            $this->createPage,
        ]);
    }
}
