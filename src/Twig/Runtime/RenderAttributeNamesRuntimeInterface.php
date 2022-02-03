<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Twig\Runtime;

interface RenderAttributeNamesRuntimeInterface
{
    public function getAttributeNames(int $id, string $locale): array;
}
