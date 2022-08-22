<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Product;

use Sylius\Behat\Page\Admin\Crud\UpdatePageInterface;

interface UpdateSimpleProductPageInterface extends UpdatePageInterface
{
    public function openTab(string $tabName): void;

    public function selectAttributeGroup(): void;

    public function addAttributeValue(string $attributeName, string $value, string $localeCode): void;

    public function saveChanges(): void;

    public function pressAddAttributeButton(): void;

    public function getAttributeValue(string $attribute, string $localeCode): string;

    public function getButtonToAddAttributesGroup(): string;
}
