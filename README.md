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

Update your database

```
app/console doctrine:schema:update --force
```

Update config.yml if you want to change the driver (not required):


```yaml
btn_settings:
    driver: doctrine #supported drivers: only doctrine
```

Usage in templates:

```twig
{{ btn_settings('meta-description') }} or {{ bs('meta-description') }}
```