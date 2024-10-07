
# Cilog

A simple log library for Internal use.

## Installation
### Laravel

**Download Cilog with composer**

```bash
composer require brighty/cilog
```

**Installation**
```bash
# Install Cilog
php artisan cilog:install
```

**Usage/Examples**

```php
use Brighty\Cilog\Cilog;


Cilog::log("Succesfully added data!", [$request->all()])
```

### Lumen
**Download Cilog with composer**

```bash
composer require brighty/cilog
```

**Modify the bootstrap flow**
```php
/** @file bootstrap/app.php */

// Register service provider
$app->register(Brighty\Cilog\Providers\LumenCilogServiceProvider::class);
```

**Installation**
```bash
# Install Cilog
php artisan cilog:install
```

**Usage/Examples**

```php
use Brighty\Cilog\Cilog;


Cilog::log("Succesfully added data!", [$request->all()])
```


## Authors

- [@eggy4prlnt](https://www.github.com/eggy4prlnt)


## License

[MIT](https://choosealicense.com/licenses/mit/)
