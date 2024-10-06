
# Cilog

A simple log library for Internal use.

## Installation

Install Cilog with composer

```bash
  composer require brighty/cilog
  php artisan cilog:install
```

## Usage/Examples

```php
use Brighty\Cilog\Cilog;


Cilog::log("Succesfully added data!", [$request->all()])
```


## Authors

- [@eggy4prlnt](https://www.github.com/eggy4prlnt)


## License

[MIT](https://choosealicense.com/licenses/mit/)
