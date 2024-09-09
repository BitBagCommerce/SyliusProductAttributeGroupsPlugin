# Installation

## Overview:
GENERAL
- [Requirements](#requirements)
- [Composer](#composer)
- [Basic configuration](#basic-configuration)
---
FRONTEND
- [Templates](#templates)
- [Webpack](#webpack)
---
ADDITIONAL
- [Additional configuration](#additional-configuration)
- [Known Issues](#known-issues)
---

## Requirements:
We work on stable, supported and up-to-date versions of packages. We recommend you to do the same.

| Package       | Version         |
|---------------|-----------------|
| PHP           | \>=8.0          |
| sylius/sylius | 1.12.x - 1.13.x |
| MySQL         | \>= 5.7         |
| NodeJS        | \>= 18.x        |

## Composer:
```bash
composer require bitbag/product-attribute-groups-plugin --no-scripts
```

## Basic configuration:
Add plugin dependencies to your `config/bundles.php` file:

```php
# config/bundles.php

return [
    ...
    BitBag\SyliusProductAttributeGroupsPlugin\BitBagSyliusProductAttributeGroupsPlugin::class => ['all' => true],
];
```

Import required config in your `config/packages/_sylius.yaml` file:

```yaml
# config/packages/_sylius.yaml

imports:
    ...
    - { resource: "@BitBagSyliusProductAttributeGroupsPlugin/Resources/config/config.yml" }
```

Add routing to your `config/routes.yaml` file:
```yaml
# config/routes.yaml

bitbag_product_attribute_groups_plugin:
    resource: "@BitBagSyliusProductAttributeGroupsPlugin/Resources/config/routing.yml"
```

### Update your database
First, please run legacy-versioned migrations by using command:
```bash
bin/console doctrine:migrations:migrate
```

After migration, please create a new diff migration and update database:
```bash
bin/console doctrine:migrations:diff
bin/console doctrine:migrations:migrate
```

### Clear application cache by using command:
```bash
bin/console cache:clear
```
**Note:** If you are running it on production, add the `-e prod` flag to this command.

## Templates
Copy required templates into correct directories in your project.

**AdminBundle** (`templates/bundles/SyliusAdminBundle`):
```
vendor/bitbag/product-attribute-groups-plugin/tests/Application/templates/bundles/SyliusAdminBundle/Product/Attribute/attributeChoice.html.twig
vendor/bitbag/product-attribute-groups-plugin/tests/Application/templates/bundles/SyliusAdminBundle/ProductAttribute/_form.html.twig
```

## Webpack
### Webpack.config.js

Please setup your `webpack.config.js` file to require the plugin's webpack configuration. To do so, please put the line below somewhere on top of your webpack.config.js file:
```js
const [ bitbagProductAttributeGroupsAdmin ] = require('./vendor/bitbag/product-attribute-groups-plugin/webpack.config.js')
```
As next step, please add the imported consts into final module exports:
```js
module.exports = [..., bitbagProductAttributeGroupsAdmin];
```

### Assets
Add the asset configuration into `config/packages/assets.yaml`:
```yaml
framework:
    assets:
        packages:
            ...
            product_attribute_groups_admin:
                json_manifest_path: '%kernel.project_dir%/public/build/bitbag/productAttributeGroups/admin/manifest.json'
```

### Webpack Encore
Add the webpack configuration into `config/packages/webpack_encore.yaml`:

```yaml
webpack_encore:
    output_path: '%kernel.project_dir%/public/build/default'
    builds:
        ...
        product_attribute_groups_admin: '%kernel.project_dir%/public/build/bitbag/productAttributeGroups/admin'
```

### Encore functions
Add encore functions to your templates:

SyliusAdminBundle:
```php
{# @SyliusAdminBundle/_scripts.html.twig #}
{{ encore_entry_script_tags('bitbag-productAttributeGroups-admin', null, 'product_attribute_groups_admin') }}

{# @SyliusAdminBundle/_styles.html.twig #}
{{ encore_entry_link_tags('bitbag-productAttributeGroups-admin', null, 'product_attribute_groups_admin') }}
```

### Run commands
```bash
yarn install
yarn encore dev # or prod, depends on your environment
```

## Known issues
### Translations not displaying correctly
For incorrectly displayed translations, execute the command:
```bash
bin/console cache:clear
```
