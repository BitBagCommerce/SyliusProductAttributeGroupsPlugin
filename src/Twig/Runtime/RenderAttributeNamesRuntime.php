<?php

namespace BitBag\SyliusProductAttributeGroupsPlugin\Twig\Runtime;

use BitBag\SyliusProductAttributeGroupsPlugin\Repository\GroupRepositoryInterface;

final class RenderAttributeNamesRuntime
{
    private GroupRepositoryInterface $groupRepository;

    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function getAttributeNames(int $id, string $locale): array {
        return $this->groupRepository->findAttributesById($id, $locale);
    }
}