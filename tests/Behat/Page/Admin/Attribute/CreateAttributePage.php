<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute;

use Sylius\Behat\Page\Admin\ProductAttribute\CreatePage;

class CreateAttributePage extends CreatePage implements CreateAttributePageInterface
{
    public function assignGroup(string $group): void
    {
        $this->getDocument()->selectFieldOption('sylius_product_attribute_group', $group);
    }
}
