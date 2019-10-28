<?php

declare(strict_types=1);

namespace Korbeil\Uuid;

use FFI;
use FFI\CData;
use KorbeilUuidPhp;

final class Uuid
{
    /** @var KorbeilUuidPhp */
    private $ffi;
    private CData $conn;

    public function __construct()
    {
        $this->ffi = FFI::load(__DIR__ . '/../include/uuid-php.h');
    }

    private function prepareOutput(): CData
    {
        return $this->ffi->new('uuid_t');
    }

    public function v1(): UuidStruct
    {
        $this->ffi->uuid_generate_time($output = $this->prepareOutput());

        return new UuidStruct($output);
    }

    public function v4(): UuidStruct
    {
        $this->ffi->uuid_generate_random($output = $this->prepareOutput());

        return new UuidStruct($output);
    }
}
