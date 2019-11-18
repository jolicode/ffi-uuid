<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use JoliCode\Uuid\UuidGenerator;

$generator = new UuidGenerator();

echo '------ v1' . "\n";
echo $generator->v1() . "\n";
echo $generator->v1() . "\n";
echo $generator->v1() . "\n";

echo '------ v3' . "\n";
echo $generator->v3('BLA') . "\n";
echo $generator->v3('BLA') . "\n";
echo $generator->v3('BLAB') . "\n";

echo '------ v4' . "\n";
echo $generator->v4() . "\n";
echo $generator->v4() . "\n";
echo $generator->v4() . "\n";

echo '------ v5' . "\n";
echo $generator->v5('BLA') . "\n";
echo $generator->v5('BLA') . "\n";
echo $generator->v5('BLAB') . "\n";
