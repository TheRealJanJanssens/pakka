# Pakka in a package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/therealjanjanssens/pakka.svg?style=flat-square)](https://packagist.org/packages/therealjanjanssens/pakka)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/therealjanjanssens/pakka/run-tests?label=tests)](https://github.com/therealjanjanssens/pakka/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/therealjanjanssens/pakka.svg?style=flat-square)](https://packagist.org/packages/therealjanjanssens/pakka)


Pakka in a package 

## Installation

You can install the package via composer:

```bash
composer require therealjanjanssens/pakka
```

We also prepared a complete setup for the pakka package with following command
```bash
php artisan pakka-install
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="TheRealJanJanssens\Pakka\PakkaServiceProvider" --tag="config"
```

## Installation for development

Provide this info for this section.

## Upgrade guide
### Database structure changes
When changing something on the structure of the database please do it with migrations and create a new stub so updating instances will be easier. Take add_permission_to_section_items_table.php.stub as example when dealing with columns and create_attribute_inputs_table.php.stub when dealing with tables
### Upgrading to 1.0 From 0.x

When updating everything below 1.0.0 to current version take a backup from the database and remove the existing database. Reconstruct it with php artisan pakka-install and insert the data back into it

## Testing
Use below commands to run the Unit tests

```bash
composer test

or

./vendor/bin/pest tests
```

If you want to run the tests like its getting triggered with Github actions first make sure you have docker installed and install arc
```brew instal act```

Once everything is installed you can simulate the Github actions with:
```act

or 

act -P ubuntu-latest=shivammathur/node:latest
```

## Custom sections, templates and layouts
If you need to change a particular section, template or layout you can simply add a 'sections', 'templates' or 'layouts' folder in your views. You can put a copy of existing resources in the folder you just made and do all the changes you want. When you update the package this folder won't be updated so your custom resources will be untouched.

Custom sections also can have their own custom thumbnail. Just add the following to your project and your set!
```php
"/public/images/sections/{nameSection}.png"
```

## Custom dynamic sections with items
This sounds a bit abstract but you can put custom html/blade in a few selected sections (For example IFRMST01004). Some of them even allow you to connect a item module to them and directly list items in your custom html/blade. To access the item variables you just use the name of the key as variable like:
```
$item['title'] => $title
$item['description'] => $description
...
```


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jan Janssens](https://github.com/TheRealJanJanssens)
- [All Contributors](../../contributors)

<!-- ## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information. -->
