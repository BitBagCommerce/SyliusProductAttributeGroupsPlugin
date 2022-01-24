# BitBag SyliusProductAttributeGroupsPlugin

----

At BitBag we do believe in open source. However, we are able to do it just because of our awesome clients, who are kind
enough to share some parts of our work with the community. Therefore, if you feel like there is a possibility for us to
work together, feel free to reach out. You will find out more about our professional services, technologies, and contact
details
at [https://bitbag.io/](https://bitbag.io/contact-us/?utm_source=github&utm_medium=referral&utm_campaign=plugins_inpost)
.

Like what we do? Want to join us? Check out our job listings on
our [career page](https://bitbag.io/career/?utm_source=github&utm_medium=referral&utm_campaign=career). Not familiar
with Symfony & Sylius yet, but still want to start with us? Join
our [academy](https://bitbag.io/pl/akademia?utm_source=github&utm_medium=url&utm_campaign=akademia)!

## Table of Content

***

* [Installation](#installation)
* [Support](#support)
* [About us](#about-us)
    * [Community](#community)
* [Demo Sylius Shop](#demo-sylius-shop)
* [License](#license)
* [Contact](#contact)

## Installation

----

1. *We work on stable, supported and up-to-date versions of packages. We recommend you to do the same.*

```bash
$ composer install bitbag/product-attribute-groups-plugin
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

## Support

This **open-source plugin was developed to help the Sylius community**. If you have any additional questions, would like
help with installing or configuring the plugin, or need any assistance with your Sylius project - let us know!

[![](https://bitbag.io/wp-content/uploads/2020/10/button-contact.png)](https://bitbag.io/contact-us/?utm_source=github&utm_medium=referral&utm_campaign=plugins_product_attribute_groups)

# About us

---

BitBag is a company of people who **love what they do** and do it right. We fulfill the eCommerce technology stack
with **Sylius**, Shopware, Akeneo, and Pimcore for PIM, eZ Platform for CMS, and VueStorefront for PWA. Our goal is to
provide real digital transformation with an agile solution that scales with the **clients’ needs**. Our main area of
expertise includes eCommerce consulting and development for B2C, B2B, and Multi-vendor Marketplaces.</br>
We are advisers in the first place. We start each project with a diagnosis of problems, and an analysis of the needs
and **goals** that the client wants to achieve.</br>
We build **unforgettable**, consistent digital customer journeys on top of the **best technologies**. Based on a
detailed analysis of the goals and needs of a given organization, we create dedicated systems and applications that let
businesses grow.<br>
Our team is fluent in **Polish, English, German and, French**. That is why our cooperation with clients from all over
the world is smooth.

**Some numbers from BitBag regarding Sylius:**

- 50+ **experts** including consultants, UI/UX designers, Sylius trained front-end and back-end developers,
- 120+ projects **delivered** on top of Sylius,
- 25+ **countries** of BitBag’s customers,
- 4+ **years** in the Sylius ecosystem.

**Our services:**

- Business audit/Consulting in the field of **strategy** development,
- Data/shop **migration**,
- Headless **eCommerce**,
- Personalized **software** development,
- **Project** maintenance and long term support,
- Technical **support**.

**Key clients:** Mollie, Guave, P24, Folkstar, i-LUNCH, Elvi Project, WestCoast Gifts.

---

If you need some help with Sylius development, don't be hesitated to contact us directly. You can fill the form
on [this site](https://bitbag.io/contact-us/?utm_source=github&utm_medium=referral&utm_campaign=plugins_cms) or send us
an e-mail at hello@bitbag.io!

---

[![](https://bitbag.io/wp-content/uploads/2021/08/sylius-badges-transparent-wide.png)](https://bitbag.io/contact-us/?utm_source=github&utm_medium=referral&utm_campaign=plugins_cms)

## Community

---- 

For online communication, we invite you to chat with us & other users on [Sylius Slack](https://sylius-devs.slack.com/).

# Demo Sylius Shop

---

We created a demo app with some useful use-cases of plugins!
Visit [sylius-demo.bitbag.io](https://sylius-demo.bitbag.io/) to take a look at it. The admin can be accessed under
[sylius-demo.bitbag.io/admin/login](https://sylius-demo.bitbag.io/admin/login) link and `bitbag: bitbag` credentials.
Plugins that we have used in the demo:

| BitBag's Plugin             | GitHub                                                      | Sylius' Store                                                  |
|-----------------------------|-------------------------------------------------------------|----------------------------------------------------------------|
| ACL Plugin                  | *Private. Available after the purchasing.*                  | https://plugins.sylius.com/plugin/access-control-layer-plugin/ |
| Braintree Plugin            | https://github.com/BitBagCommerce/SyliusBraintreePlugin     | https://plugins.sylius.com/plugin/braintree-plugin/            |
| CMS Plugin                  | https://github.com/BitBagCommerce/SyliusCmsPlugin           | https://plugins.sylius.com/plugin/cmsplugin/                   |
| Elasticsearch Plugin        | https://github.com/BitBagCommerce/SyliusElasticsearchPlugin | https://plugins.sylius.com/plugin/2004/                        |
| Mailchimp Plugin            | https://github.com/BitBagCommerce/SyliusMailChimpPlugin     | https://plugins.sylius.com/plugin/mailchimp/                   |
| Multisafepay Plugin         | https://github.com/BitBagCommerce/SyliusMultiSafepayPlugin  |
| Wishlist Plugin             | https://github.com/BitBagCommerce/SyliusWishlistPlugin      | https://plugins.sylius.com/plugin/wishlist-plugin/             |
| **Sylius' Plugin**          | **GitHub**                                                  | **Sylius' Store**                                              |
| Admin Order Creation Plugin | https://github.com/Sylius/AdminOrderCreationPlugin          | https://plugins.sylius.com/plugin/admin-order-creation-plugin/ |
| Invoicing Plugin            | https://github.com/Sylius/InvoicingPlugin                   | https://plugins.sylius.com/plugin/invoicing-plugin/            |
| Refund Plugin               | https://github.com/Sylius/RefundPlugin                      | https://plugins.sylius.com/plugin/refund-plugin/               |

**If you need an overview of Sylius' capabilities, schedule a consultation with our expert.**

[![](https://bitbag.io/wp-content/uploads/2020/10/button_free_consulatation-1.png)](https://bitbag.io/contact-us/?utm_source=github&utm_medium=referral&utm_campaign=plugins_cms)

## Additional resources for developers

---
To learn more about our contribution workflow and more, we encourage you to use the following resources:

* [Sylius Documentation](https://docs.sylius.com/en/latest/)
* [Sylius Contribution Guide](https://docs.sylius.com/en/latest/contributing/)
* [Sylius Online Course](https://sylius.com/online-course/)

## License

---

This plugin's source code is completely free and released under the terms of the MIT license.

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen.)

## Contact

---
If you want to contact us, the best way is to fill the form
on [our website](https://bitbag.io/contact-us/?utm_source=github&utm_medium=referral&utm_campaign=plugins_cms) or send
us an e-mail to hello@bitbag.io with your question(s). We guarantee that we answer as soon as we can!

[![](https://bitbag.io/wp-content/uploads/2021/08/badges-bitbag.png)](https://bitbag.io/contact-us/?utm_source=github&utm_medium=referral&utm_campaign=plugins_cms)
