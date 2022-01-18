<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Context;

use Behat\Behat\Context\Context;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute\CreateAttributePageInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute\UpdateAttributePageInterface;
use Webmozart\Assert\Assert;

class AttributeContext implements Context
{
    private CreateAttributePageInterface $createPage;

    private UpdateAttributePageInterface $updatePage;

    public function __construct(CreateAttributePageInterface $createPage, UpdateAttributePageInterface $updatePage)
    {
        $this->createPage = $createPage;
        $this->updatePage = $updatePage;
    }

    /**
     * @When I want to create a new :type product attribute
     */
    public function iWantToCreateANewTextProductAttribute(string $type): void
    {
        $this->createPage->open(['type' => $type]);
    }

    /**
     * @When I name it :name in :language
     */
    public function iNameItIn(string $name, string $language): void
    {
        $this->createPage->nameIt($name, $language);
    }

    /**
     * @When I specify its code as :code
     */
    public function iSpecifyItsCodeAs(string $code): void
    {
        $this->createPage->specifyCode($code);
    }

    /**
     * @When I assign group named :group to it
     */
    public function iAssignGroupNamedToIt(string $group): void
    {
        $this->createPage->assignGroup($group);
    }

    /**
     * @Then this product attribute should have assigned group with name :group
     */
    public function thisProductAttributeShouldHaveAssignedGroupWithName(string $group): void
    {
        Assert::true($this->updatePage->isGroupAssigned($group));
    }
}
