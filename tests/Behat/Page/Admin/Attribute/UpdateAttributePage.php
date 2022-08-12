<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute;

use Sylius\Behat\Page\Admin\ProductAttribute\UpdatePage;

final class UpdateAttributePage extends UpdatePage implements UpdateAttributePageInterface
{
    public function isGroupAssigned(string $group): bool
    {
        $groups = $this->getDocument()->findField('sylius_product_attribute_groups')->getValue();

		return in_array($group, $groups);
    }
}
