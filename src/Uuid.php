<?php

declare(strict_types=1);

namespace JoliCode\Uuid;

use FFI;
use FFI\CData;

final class Uuid
{
    private CData $value;
    private ?string $cached = null;

    /** @var \JoliCodeUuidPhp $ffi */
    public static function createFromString(string $uuid, FFI $ffi): self
    {
        $matches = [];
        preg_match_all('/([0-9a-z]){2}/', $uuid, $matches);

        $value = $ffi->new('uuid_t');
        foreach ($matches[0] as $k => $item) {
            $value[$k] = hexdec($item);
        }

        return new self($value, $uuid);
    }

    public function __construct(CData $value, string $cached = null)
    {
        $this->value = $value;
        $this->cached = $cached;
    }

    public function toCData(): CData
    {
        return $this->value;
    }

    public function __toString(): string
    {
        if (null === $this->cached) {
            // Covert int[] to a string
            foreach ($this->value as $values[]) ;

            $this->cached = sprintf('%02x%02x%02x%02x-%02x%02x-%02x%02x-%02x%02x-%02x%02x%02x%02x%02x%02x', ...$values);
        }

        return $this->cached;
    }
}
