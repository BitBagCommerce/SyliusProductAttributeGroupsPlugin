<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group;

use Sylius\Behat\Page\Admin\Crud\CreatePageInterface;

interface CreateGroupPageInterface extends CreatePageInterface
{
    public function fillName(string $name): void;

	public function assignAttributes(array $codes): void;
}
