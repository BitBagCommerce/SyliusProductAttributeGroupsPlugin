<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group;

use Sylius\Behat\Page\Admin\Crud\IndexPageInterface;

interface IndexGroupPageInterface extends IndexPageInterface
{
    public function isGroupDisplayed(string $group): bool;

	public function areAttributesVisible(string $group, array $attributes): bool;
}
