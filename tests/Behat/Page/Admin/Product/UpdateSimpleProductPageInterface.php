<?php
declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Product;

use Sylius\Behat\Page\Admin\Crud\UpdatePageInterface;

interface UpdateSimpleProductPageInterface extends UpdatePageInterface
{
    public function openTab(string $tabName): void;

    public function selectAttributeGroup(): void;

    public function addAttributeValue(string $attributeName, string $value, string $localeCode): void;

    public function saveChanges(): void;

    public function getAttributeValue(string $attribute, string $localeCode): string;

    public function getButtonToAddAttributesGroup(): string;
}
