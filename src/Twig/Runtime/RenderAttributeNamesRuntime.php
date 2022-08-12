<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Twig\Runtime;

use BitBag\SyliusProductAttributeGroupsPlugin\Repository\GroupRepositoryInterface;

final class RenderAttributeNamesRuntime implements RenderAttributeNamesRuntimeInterface
{
    private GroupRepositoryInterface $groupRepository;

    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function getAttributeNames(int $id, string $locale): array
    {
        return $this->groupRepository->findAttributesById($id, $locale);
    }
}
