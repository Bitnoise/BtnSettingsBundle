BtnSettings
===========

Install:
```json
"require": {
    "bitnoise/settings-bundle": "dev-master"
},
"repositories": [
    {
        "type": "vcs",
        "url":  "git@github.com:Bitnoise/BtnSettingsBundle.git"
    }
],
```

Install via composer

```
composer install or composer update
```

Register bundle in the AppKernel.php file

```php
new Btn\SettingsBundle\BtnSettingsBundle()
```

Update your database

```
app/console doctrine:schema:update --force
```

Update config.yml if you want to change the driver (not required):


```yaml
btn_settings:
    driver: doctrine #supported drivers: only doctrine
```

Usage in controllers
```php
//set value
$this->get('btn.settings')->set('meta-description', 'Some dummy description');
//get value
$this->get('btn.settings')->get('meta-description');
```

Usage in templates:

```twig
{{ btn_settings('meta-description') }} or {{ bs('meta-description') }}
```

Default values: (not required)
You can predefine some settings in your parameters.yml file in the btn_settings namespace
for example:

```yaml
parameters:
    btn_settings.defaults:
        meta-title:       'title'
        meta-keywords:    'keywords'
```

This way, when the first get will be call, settings bundle will save those values using correct driver.