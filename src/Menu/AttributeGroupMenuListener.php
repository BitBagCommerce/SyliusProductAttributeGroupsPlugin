<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AttributeGroupMenuListener {
	public function groupList(MenuBuilderEvent $event): void {
		$menu = $event->getMenu();

		$menu
			->getChild('catalog')
			->addChild('subitem', [
				'route' => 'bitbag_sylius_product_attribute_group_plugin_admin_group_index'
			])
			->setLabel('bitbag_sylius_product_attribute_group_plugin.ui.groups')
			->setLabelAttribute('icon', 'tags');
	}
}
