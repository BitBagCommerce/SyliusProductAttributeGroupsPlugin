<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Tests\BitBag\SyliusProductAttributeGroupsPlugin\Behat\Page\Admin\CreateGroupPageInterface;

final class AttributeGroupsContext implements Context {
	private CreateGroupPageInterface $createPage;

	public function __construct(CreateGroupPageInterface $createPage) {
		$this->createPage = $createPage;
	}

	/**
	 * @When I want to add a new attribute group
	 */
	public function iWantToAddANewAttributeGroup(): void
	{
		$this->createPage->open();
	}

	/**
	 * @When I set its name to :arg1
	 */
	public function iSetItsNameTo($arg1): void
	{
		throw new PendingException();
	}

	/**
	 * @When I add it
	 */
	public function iAddIt(): void
	{
		throw new PendingException();
	}


	/**
	 * @Then the group :arg1 should appear in the store
	 */
	public function theGroupShouldAppearInTheStore(string $group): void
	{
		throw new PendingException();
	}
}
