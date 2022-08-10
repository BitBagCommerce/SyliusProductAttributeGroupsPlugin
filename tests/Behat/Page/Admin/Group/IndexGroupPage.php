<?php

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\Group;

use Behat\Mink\Element\NodeElement;
use Sylius\Behat\Page\Admin\Crud\IndexPage;

final class IndexGroupPage extends IndexPage implements IndexGroupPageInterface
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

    public function areAttributesVisible(string $group, array $attributes): bool
    {
        $row = $this->getDocument()->find('css', sprintf('table tr:contains("%s")', $group));

        foreach ($attributes as $attribute) {
            $attributeBadge = $row->find('xpath', sprintf('td[2]/span[text()="%s"]', $attribute));
            if (null === $attributeBadge) {
                return false;
            }
        }

        return true;
    }
}
