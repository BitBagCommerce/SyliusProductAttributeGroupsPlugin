<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AttributeGroupMenuListener
{
    public function groupList(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $catalogNode = $menu->getChild('catalog');

        if (null === $catalogNode) {
            return;
        }

        $catalogNode
            ->addChild('subitem', [
                'route' => 'bitbag_sylius_product_attribute_group_plugin_admin_group_index',
            ])
            ->setLabel('bitbag_sylius_product_attribute_group_plugin.ui.groups')
            ->setLabelAttribute('icon', 'tags');
    }
}
