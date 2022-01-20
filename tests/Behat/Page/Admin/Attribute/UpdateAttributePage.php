<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute;

use Sylius\Behat\Page\Admin\ProductAttribute\UpdatePage;

class UpdateAttributePage extends UpdatePage implements UpdateAttributePageInterface
{
    public function isGroupAssigned(string $group): bool
    {
        return $group === $this->getDocument()->findField('sylius_product_attribute_group')->getValue();
    }
}
