<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Korbeil\Uuid\UuidFactory;

$factory = new UuidFactory();

var_dump('------ v1');
var_dump($factory->v1()->toString());
var_dump($factory->v1()->toString());
var_dump($factory->v1()->toString());

var_dump('------ v4');
var_dump($factory->v4()->toString());
var_dump($factory->v4()->toString());
var_dump($factory->v4()->toString());

var_dump('------ v3');
var_dump($factory->v3('BLA')->toString());
var_dump($factory->v3('BLA')->toString());
var_dump($factory->v3('BLAB')->toString());

var_dump('------ v5');
var_dump($factory->v5('BLA')->toString());
var_dump($factory->v5('BLA')->toString());
var_dump($factory->v5('BLAB')->toString());

echo "\n";
