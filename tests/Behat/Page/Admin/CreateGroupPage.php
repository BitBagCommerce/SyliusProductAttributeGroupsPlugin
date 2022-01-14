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

    public function getRouteName(): string
    {
        return 'bitbag_sylius_product_attribute_group_plugin_admin_group_create';
    }
}
