<?php

require __DIR__.'/vendor/autoload.php';

$count = 1 * 1000 * 1000;
$generator = new JoliCode\Uuid\UuidGenerator();

$s = microtime(true);
for ($i = 0; $i < $count; ++$i) {
    $generator->v1();
}
printf("Bench [v1] %.3fs - ", microtime(true) - $s);

$s = microtime(true);
for ($i = 0; $i < $count; ++$i) {
    $generator->v4();
}
printf("[v4] %.3fs", microtime(true) - $s);

print("\n");
