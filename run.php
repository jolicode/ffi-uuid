<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Korbeil\Uuid\Uuid;

$uuid = new Uuid();
$struct = $uuid->v1();

echo $struct;
