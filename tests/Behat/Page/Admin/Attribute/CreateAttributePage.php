<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute;

use Sylius\Behat\Page\Admin\ProductAttribute\CreatePage;

final class CreateAttributePage extends CreatePage implements CreateAttributePageInterface
{
    public function assignGroup(string $group): void
    {
        $this->getDocument()->selectFieldOption('sylius_product_attribute_groups', $group);
    }

    public function createAttribute(
        string $attribute,
        string $code,
        ?string $group
    ): void {
        $this->open(['type' => 'text']);
        $this->nameIt($attribute, 'en_US');
        $this->specifyCode($code);

        if (null !== $group) {
            $this->assignGroup($group);
        }

        $this->create();
    }
}
