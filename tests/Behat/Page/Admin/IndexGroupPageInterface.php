<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin;

use Sylius\Behat\Page\Admin\Crud\IndexPageInterface;

interface IndexGroupPageInterface extends IndexPageInterface
{
    public function isGroupDisplayed(string $group): bool;
}
