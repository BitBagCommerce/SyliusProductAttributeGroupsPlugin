<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Context;

use Behat\Behat\Context\Context;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute\CreateAttributePageInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute\UpdateAttributePageInterface;
use Webmozart\Assert\Assert;

final class AttributeContext implements Context
{
    private CreateAttributePageInterface $createPage;

    private UpdateAttributePageInterface $updatePage;

    private RepositoryInterface $attributeRepository;

    public function __construct(
        CreateAttributePageInterface $createPage,
        UpdateAttributePageInterface $updatePage,
        RepositoryInterface $attributeRepository
    ) {
        $this->createPage = $createPage;
        $this->updatePage = $updatePage;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @Given there is created text attribute :attribute with code :code and assigned group :group
     * @Given there is created text attribute :attribute with code :code
     */
    public function thereIsCreatedAttributeWithAssignedGroupAndCode(
        string $attribute,
        string $code,
        string $group = null
    ) {
        $this->createPage->open(['type' => 'text']);
        $this->createPage->nameIt($attribute, 'en_US');
        $this->createPage->specifyCode($code);

        if (null !== $group) {
            $this->createPage->assignGroup($group);
        }

        $this->createPage->create();
    }

    /**
     * @When I want to create a new text product attribute
     */
    public function iWantToCreateANewTextProductAttribute(): void
    {
        $this->createPage->open(['type' => 'text']);
    }

    /**
     * @When I want to edit attribute with code :code
     */
    public function iWantToEditAttributeWithCode(string $code)
    {
        $id = $this->attributeRepository->findOneBy(['code' => $code])->getId();

        $this->updatePage->open(['id' => $id]);
    }

    /**
     * @When I save my changes
     */
    public function iSaveMyChanges()
    {
        $this->updatePage->saveChanges();
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
