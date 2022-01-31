<?php

namespace BitBag\SyliusProductAttributeGroupsPlugin\Repository;


use Sylius\Component\Resource\Repository\RepositoryInterface;

interface GroupRepositoryInterface extends RepositoryInterface
{
    public function findAttributesById(int $id, string $locale): array;
}