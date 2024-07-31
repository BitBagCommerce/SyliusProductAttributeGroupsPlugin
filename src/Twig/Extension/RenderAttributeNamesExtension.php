<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
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
