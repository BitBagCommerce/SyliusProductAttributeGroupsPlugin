<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Product;

use Sylius\Behat\Page\Admin\Crud\UpdatePage;

final class UpdateSimpleProductPage extends UpdatePage implements UpdateSimpleProductPageInterface
{
    public function openTab(string $tabName): void
    {
        $attributesTab = $this->getElement('tab', ['%name%' => $tabName]);
        if (!$attributesTab->hasClass('active')) {
            $attributesTab->click();
        }
    }

    public function selectAttributeGroup(): void
    {
        $this->getDocument()->pressButton('Add attribute group');

        $attributesTab = $this->getElement('tab', ['%name%' => 'attribute-group']);
        $attributesTab->click();

        $this->waitForElement(5, 'attribute_value');
    }

    public function addAttributeValue(string $attributeName, string $value, string $localeCode): void
    {
        $this->getElement('attribute_value', ['%attributeName%' => $attributeName, '%localeCode%' => $localeCode])->setValue($value);
    }

    public function saveChanges(): void
    {
        $this->getDocument()->pressButton('sylius_save_changes_button');
    }

    public function getAttributeValue(string $attribute, string $localeCode): string
    {
        $this->openTab('attributes');

        return $this->getElement('attribute', ['%attributeName%' => $attribute, '%localeCode%' => $localeCode])->getValue();
    }

    public function getButtonToAddAttributesGroup(): string
    {
        $attributeGroupButton = $this->getDocument()->find('css', '#add_attributes_group');
        return $attributeGroupButton->getAttribute('data-tab');
    }

    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'tab' => '.menu [data-tab="%name%"]',
            'attribute_value' => '#attributesContainer [data-test-product-attribute-value-in-locale="%attributeName% %localeCode%"] input',
            'attribute' => '#attributesContainer [data-test-product-attribute-value-in-locale="%attributeName% %localeCode%"] input',
        ]);
    }

    private function waitForElement(int $timeout, string $elementName): void
    {
        $this->getDocument()->waitFor($timeout, function () use ($elementName) {
            return $this->hasElement($elementName);
        });
    }
}
