<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Attribute;

use Sylius\Behat\Page\Admin\ProductAttribute\CreatePageInterface;

interface CreateAttributePageInterface extends CreatePageInterface
{
    public function assignGroup(string $group): void;
}
