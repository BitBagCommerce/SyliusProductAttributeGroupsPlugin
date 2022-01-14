<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin;

use Sylius\Behat\Page\Admin\Crud\CreatePage;

class CreateGroupPage extends CreatePage implements CreateGroupPageInterface
{
    public function fillName(string $name): void
    {
        $this->getDocument()->fillField('Name', $name);
    }
}
