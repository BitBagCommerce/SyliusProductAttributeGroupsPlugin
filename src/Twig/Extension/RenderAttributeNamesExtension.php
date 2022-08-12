<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

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
