## Installation

1. *We work on stable, supported and up-to-date versions of packages. We recommend you to do the same.*

```bash
$ bitbag/product-attribute-groups-plugin
```

2. Add plugin dependencies to your `config/bundles.php` file:

```php
return [
    ...

    BitBag\SyliusProductAttributeGroupsPlugin\BitBagSyliusProductAttributeGroupsPlugin::class => ['all' => true],
];
```

3. Import required config in your `config/packages/_sylius.yaml` file:

```yaml
# config/packages/_sylius.yaml

imports:
    ...

    - { resource: "@BitBagSyliusProductAttributeGroupsPlugin/Resources/config/config.yml" }
```

4. Import required grid:

```yaml
# config/packages/_sylius.yaml

sylius_grid:
    grids:
        ...

        bitbag_sylius_product_attribute_group:
            driver:
                options:
                    class: BitBag\SyliusProductAttributeGroupsPlugin\Entity\Group
            fields:
                name:
                    type: string
                    label: bitbag_sylius_product_attribute_group_plugin.ui.name
                attributes:
                    type: twig
                    label: bitbag_sylius_product_attribute_group_plugin.ui.attributes
                    options:
                        template: "@BitBagSyliusProductAttributeGroupsPlugin/Grid/Field/attributes.html.twig"
            actions:
                main:
                    create:
                        type: create
                item:
                    update:
                        type: update
                    delete:
                        type: delete
```

5. Add required routes:
```yaml
# config/routes/bitbag_product_attribute_groups_plugin.yaml

sylius_admin_attribute_group:
    resource: |
        alias: bitbag_sylius_product_attribute_group_plugin.group
        except: ['show']
        section: admin
        templates: "@SyliusAdmin/Crud"
        grid: bitbag_sylius_product_attribute_group
    type: sylius.resource
    prefix: /admin/product-attribute-groups-plugin

```

6. Override product attribute form:
```
# templates/bundles/SyliusAdminBundle/ProductAttribute/_form.html.twig

{% from '@SyliusAdmin/Macro/translationForm.html.twig' import translationForm %}

{{ form_errors(form) }}

<div class="ui segment">
    <div class="four fields">
        {{ form_row(form.code) }}
        {{ form_row(form.position) }}
        {{ form_row(form.type) }}
        {{ form_row(form.group) }}
    </div>
    {{ form_row(form.translatable) }}
</div>
{% if form.configuration is defined %}
    <div class="ui segment">
        <h4 class="ui dividing header">{{ 'sylius.ui.configuration'|trans }}</h4>
        {% for field in form.configuration %}
            {{ form_row(field) }}
        {% endfor %}
    </div>
{% endif %}
{{ translationForm(form.translations) }}
```
