<?php

require __DIR__.'/vendor/autoload.php';

$count = 1 * 1000 * 1000;
$generator = new JoliCode\Uuid\UuidGenerator();

print "FFI:\n";

$s = microtime(true);
for ($i = 0; $i < $count; ++$i) {
    $generator->v1();
}
printf(" * [v1] %.3fs\n", microtime(true) - $s);

$s = microtime(true);
for ($i = 0; $i < $count; ++$i) {
    $generator->v4();
}
printf(" * [v4] %.3fs\n", microtime(true) - $s);

if (function_exists('uuid_create')) {
    print "PECL:\n";

    $s = microtime(true);
    for ($i = 0; $i < $count; ++$i) {
        uuid_create(UUID_TYPE_TIME);
    }
    printf(" * [v1] %.3fs\n", microtime(true) - $s);

    $s = microtime(true);
    for ($i = 0; $i < $count; ++$i) {
        uuid_create(UUID_TYPE_RANDOM);
    }
    printf(" * [v4] %.3fs\n", microtime(true) - $s);
}
