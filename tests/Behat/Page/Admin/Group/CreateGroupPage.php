<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group;

use Sylius\Behat\Page\Admin\Crud\CreatePage;

class CreateGroupPage extends CreatePage implements CreateGroupPageInterface
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
