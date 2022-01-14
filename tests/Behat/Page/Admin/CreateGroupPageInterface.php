<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin;

use Sylius\Behat\Page\Admin\Crud\CreatePageInterface;

interface CreateGroupPageInterface extends CreatePageInterface
{
    public function fillName(string $name): void;
}
