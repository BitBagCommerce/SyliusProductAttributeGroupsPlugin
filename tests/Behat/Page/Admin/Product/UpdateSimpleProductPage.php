<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Product;

use Sylius\Behat\Page\Admin\Crud\CreatePage;

class UpdateSimpleProductPage extends CreatePage
{
    public function addSelectedAttributesGroup(): void
    {
        $this->clickTabIfItsNotActive('attributes');
    }

    private function clickTabIfItsNotActive(string $tabName): void
    {
        $attributesTab = $this->getElement('tab', ['%name%' => $tabName]);
        if (!$attributesTab->hasClass('active')) {
            $attributesTab->click();
        }
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
        ]);
    }
}
