<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Context\Ui;

use Behat\Behat\Context\Context;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute\CreateAttributePageInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute\UpdateAttributePageInterface;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Product\UpdateSimpleProductPage;
use Webmozart\Assert\Assert;

final class AttributeContext implements Context
{
    private UpdateSimpleProductPage $updateSimpleProductPage;

    private CreateAttributePageInterface $createAttributePage;

    private UpdateAttributePageInterface $updatePage;

    private RepositoryInterface $attributeRepository;

    public function __construct(
        UpdateSimpleProductPage $productPage,
        CreateAttributePageInterface $createAttributePage,
        UpdateAttributePageInterface $updatePage,
        RepositoryInterface $attributeRepository
    ) {
        $this->updateSimpleProductPage = $productPage;
        $this->createAttributePage = $createAttributePage;
        $this->updatePage = $updatePage;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @When I set its :attribute attribute to :value
     * @When I set its :attribute attribute to :value in :language
     * @When I do not set its :attribute attribute in :language
     */
    public function iSetItsAttributeTo($attribute, $value = null, $language = 'en_US'): void
    {
        $this->updateSimpleProductPage->addAttributeValue($attribute, $value ?? '', $language);
    }

    /**
     * @Then attribute :attributeName of product :product should be :value
     * @Then attribute :attributeName of product :product should be :value in :language
     */
    public function itsAttributeShouldBe($attributeName, ProductInterface $product, $value, $language = 'en_US'): void
    {
        Assert::same($this->updateSimpleProductPage->getAttributeValue($attributeName, $language), $value);
    }

    /**
     * @Given there is created text attribute :attribute with code :code and assigned group :group
     * @Given there is created text attribute :attribute with code :code
     */
    public function thereIsCreatedAttributeWithAssignedGroupAndCode(
        string $attribute,
        string $code,
        string $group = null
    ): void {
        $this->createAttributePage->createAttribute($attribute, $code, $group);
    }

    /**
     * @When I assign group named :group to it
     */
    public function iAssignGroupNamedToIt(string $group): void
    {
        $this->createAttributePage->assignGroup($group);
    }

    /**
     * @Then this product attribute should have assigned group with name :group
     */
    public function thisProductAttributeShouldHaveAssignedGroupWithName(string $group): void
    {
        Assert::true($this->updatePage->isGroupAssigned($group));
    }

    /**
     * @When I want to create a new text product attribute
     */
    public function iWantToCreateANewTextProductAttribute(): void
    {
        $this->createAttributePage->open(['type' => 'text']);
    }

    /**
     * @When I want to edit attribute with code :code
     */
    public function iWantToEditAttributeWithCode(string $code): void
    {
        $id = $this->attributeRepository->findOneBy(['code' => $code])->getId();

        $this->updatePage->open(['id' => $id]);
    }

    /**
     * @When I name it :name in :language
     */
    public function iNameItIn(string $name, string $language): void
    {
        $this->createAttributePage->nameIt($name, $language);
    }

    /**
     * @When I specify its code as :code
     */
    public function iSpecifyItsCodeAs(string $code): void
    {
        $this->createAttributePage->specifyCode($code);
    }

    /**
     * @When I save my changes
     */
    public function iSaveMyChanges(): void
    {
        $this->updatePage->saveChanges();
    }
}
