<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group;

use Sylius\Behat\Page\Admin\Crud\CreatePage;

final class CreateGroupPage extends CreatePage implements CreateGroupPageInterface
{
    public function fillName(string $name): void
    {
        $this->getDocument()->fillField('Name', $name);
    }

    public function assignAttributes(array $codes): void
    {
        $this->getDocument()->findField('group_attributes')->setValue($codes);
    }

    public function createGroup(string $group): void
    {
        $this->open();
        $this->fillName($group);
        $this->create();
    }
}
