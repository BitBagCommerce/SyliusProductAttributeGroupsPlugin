<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Twig\Extension;

use BitBag\SyliusProductAttributeGroupsPlugin\Twig\Runtime\RenderAttributeNamesRuntime;
use Twig\Extension\AbstractExtension;
use Twig\Extension\ExtensionInterface;
use Twig\TwigFunction;

class RenderAttributeNamesExtension extends AbstractExtension implements ExtensionInterface
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('bitbag_attribute_plugin_get_attribute_names', [RenderAttributeNamesRuntime::class, 'getAttributeNames']),
        ];
    }
}
