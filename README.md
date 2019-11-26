# FFI libuuid

This repository contains a binding of the `libuuid` library with PHP thanks to PHP/FFI. So this requires PHP 7.4 to run.

For now this is mostly a proof of concept to demonstrate the power of the FFI extenstion. In future, if and when the performance of FFI improves, it could be a good alternative to the [PECL UUID package](https://pecl.php.net/package/uuid).

Further details can be found in a French language blog post [PHP 7.4 et FFI, ce qu’il faut retenir](https://jolicode.com/blog/php-7-4-et-ffi-ce-quil-faut-retenir) (*PHP 7.4 and FFI: what to remember*).

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
