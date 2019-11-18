# FFI libuuid

This repository contains a binding of the `libuuid` library with PHP thanks to PHP/FFI. So this requires PHP 7.4 to run.

## Installation

```bash
composer require jolicode/ffi-uuid
```

## Usage

```php
use JoliCode\Uuid\UuidGenerator;

$generator = new UuidGenerator();

echo $generator->v1();
echo $generator->v3('something');
echo $generator->v4();
echo $generator->v5('something');
```

## Resources

- Uuid: https://en.wikipedia.org/wiki/Universally_unique_identifier
- libuuid: https://git.kernel.org/pub/scm/fs/ext2/e2fsprogs.git/tree/lib/uuid
- Inspiration: https://github.com/paxal/php-dbus
