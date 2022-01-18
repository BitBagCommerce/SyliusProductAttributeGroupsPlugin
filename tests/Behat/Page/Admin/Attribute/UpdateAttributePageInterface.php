<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute;

use Sylius\Behat\Page\Admin\ProductAttribute\UpdatePageInterface;

interface UpdateAttributePageInterface extends UpdatePageInterface
{
    public function isGroupAssigned(string $group): bool;
}
