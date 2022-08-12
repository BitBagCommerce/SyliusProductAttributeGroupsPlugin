<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

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
