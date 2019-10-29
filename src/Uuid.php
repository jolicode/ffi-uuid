<?php

declare(strict_types=1);

namespace Korbeil\Uuid;

use FFI;
use FFI\CData;

final class Uuid
{
    const UUID_SEPARATORS = [4, 2, 2, 2, 6];

    private array $value = [];
    private ?string $cached = null;

    public static function createFromString(string $uuid): self
    {
        $matches = [];
        preg_match_all('/([0-9a-z]){2}/', $uuid, $matches);

        $value = [];
        foreach ($matches[0] as $item) {
            $value[] = hexdec($item);
        }

        return new self($value, $uuid);
    }

    public static function createFromCData(CData $uuid): self
    {
        $value = [];

        foreach($uuid as $item) {
            $value[] = $item;
        }

        return new self($value);
    }

    public function __construct(array $value, string $cached = null)
    {
        $this->value = $value;
        $this->cached = $cached;
    }

    public function toString(): string
    {
        if (null === $this->cached) {
            $this->cachedString();
        }

        return $this->cached;
    }

    private function cachedString(): void
    {
        $incr = 0;
        $output = '';
        $iterator = new \ArrayIterator(self::UUID_SEPARATORS);

        foreach ($this->value as $item) {
            $output .= dechex($item);

            ++$incr;
            if ($incr === $iterator->current()) {
                $incr = 0;
                $iterator->next();

                if ($iterator->valid()) {
                    $output .= '-';
                }
            }
        }

        $this->cached = $output;
    }

    /**
     * @param \KorbeilUuidPhp $ffi
     */
    public function toCData(FFI $ffi): CData
    {
        $data = $ffi->new('uuid_t');

        foreach ($this->value as $k => $item) {
            $data[$k] = $item;
        }

        return $data;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
