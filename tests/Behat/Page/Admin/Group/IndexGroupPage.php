<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group;

use Behat\Mink\Element\NodeElement;
use Sylius\Behat\Page\Admin\Crud\IndexPage;

class IndexGroupPage extends IndexPage implements IndexGroupPageInterface
{
    public function isGroupDisplayed(string $group): bool
    {
        $table = $this->getElement('table');
        $row = $table->find('css', sprintf('table tr:contains("%s")', $group));

        if ($row instanceof NodeElement) {
            return true;
        }

        return false;
    }
}
